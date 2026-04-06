<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$configFile = __DIR__ . '/config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    echo json_encode(['error' => 'config.php не найден на сервере']);
    exit;
}
$config = require $configFile;

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный формат данных']);
    exit;
}

$name    = trim($input['name'] ?? '') ?: '—';
$phone   = trim($input['phone'] ?? '') ?: '—';
$email   = trim($input['email'] ?? '') ?: '—';
$message = trim($input['message'] ?? '') ?: '—';
$needLawyer       = !empty($input['needLawyer']);
$needFinancist    = !empty($input['needFinancist']);
$consentMarketing = !empty($input['consentMarketing']);

$contact = ($phone !== '—') ? $phone : (($email !== '—') ? $email : '—');
$subject = "Новая заявка: $name $contact";
$html    = buildEmailHtml($name, $phone, $email, $message, $needLawyer, $needFinancist, $consentMarketing);

$result = smtpSend(
    $config['smtp_host'],
    $config['smtp_port'],
    $config['email'],
    $config['password'],
    $config['email'],
    $config['email'],
    $subject,
    $html
);

if ($result === true) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode([
        'error'  => 'Не удалось отправить письмо.',
        'detail' => $result,
    ]);
}

/* ── SMTP ────────────────────────────────────────────── */

/**
 * Читает ответ SMTP до конца многострочной последовательности (RFC 5321).
 * Последняя строка: «код + пробел», промежуточные: «код + дефис».
 */
function smtp_read_response($sock) {
    $buffer = '';
    $max = 64;
    while (--$max > 0) {
        $line = fgets($sock, 8192);
        if ($line === false) {
            break;
        }
        $buffer .= $line;
        if (strlen($line) >= 4 && $line[3] === ' ') {
            break;
        }
    }
    return $buffer;
}

function smtp_connect_ssl($host, $port) {
    $ctx = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);
    $sock = @stream_socket_client(
        "ssl://$host:$port",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $ctx
    );
    if ($sock) {
        stream_set_timeout($sock, 30);
    }
    return [$sock, $errno, $errstr];
}

function smtp_auth_plain($sock, $user, $pass) {
    $plain = base64_encode("\0" . $user . "\0" . $pass);
    fputs($sock, 'AUTH PLAIN ' . $plain . "\r\n");
    $authLine = trim(smtp_read_response($sock));
    $code = strlen($authLine) >= 3 ? substr($authLine, 0, 3) : '';
    return $code === '235' ? true : $authLine;
}

function smtp_auth_login($sock, $user, $pass) {
    fputs($sock, "AUTH LOGIN\r\n");
    smtp_read_response($sock);
    fputs($sock, base64_encode($user) . "\r\n");
    smtp_read_response($sock);
    fputs($sock, base64_encode($pass) . "\r\n");
    $authLine = trim(smtp_read_response($sock));
    $code = strlen($authLine) >= 3 ? substr($authLine, 0, 3) : '';
    return $code === '235' ? true : $authLine;
}

function smtpSend($host, $port, $user, $pass, $from, $to, $subject, $htmlBody) {
    [$sock, $errno, $errstr] = smtp_connect_ssl($host, $port);
    if (!$sock) {
        return "Connection failed: $errstr ($errno)";
    }

    $greet = smtp_read_response($sock);
    if (!preg_match('/^220/m', trim($greet))) {
        fclose($sock);
        return 'Bad greeting: ' . trim($greet);
    }

    $ehloHost = preg_replace('/[^\w.-]+/', '', (string) gethostname()) ?: 'localhost';
    fputs($sock, "EHLO $ehloHost\r\n");
    smtp_read_response($sock);

    $authOk = smtp_auth_plain($sock, $user, $pass);
    if ($authOk !== true) {
        $plainErr = $authOk;
        fclose($sock);

        [$sock2, $errno2, $errstr2] = smtp_connect_ssl($host, $port);
        if (!$sock2) {
            return "Connection failed (retry): $errstr2 ($errno2)";
        }
        smtp_read_response($sock2);
        fputs($sock2, "EHLO $ehloHost\r\n");
        smtp_read_response($sock2);

        $authOk2 = smtp_auth_login($sock2, $user, $pass);
        if ($authOk2 !== true) {
            fclose($sock2);
            return 'Auth failed: ' . $authOk2 . ' (PLAIN: ' . $plainErr . ')';
        }
        $sock = $sock2;
    }

    fputs($sock, "MAIL FROM:<$from>\r\n");
    smtp_read_response($sock);

    fputs($sock, "RCPT TO:<$to>\r\n");
    smtp_read_response($sock);

    fputs($sock, "DATA\r\n");
    smtp_read_response($sock);

    $msg  = "From: =?UTF-8?B?" . base64_encode('Экстренная бухгалтерия') . "?= <$from>\r\n";
    $msg .= "To: <$to>\r\n";
    $msg .= "Reply-To: <$from>\r\n";
    $msg .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
    $msg .= "MIME-Version: 1.0\r\n";
    $msg .= "Content-Type: text/html; charset=UTF-8\r\n";
    $msg .= "Content-Transfer-Encoding: base64\r\n";
    $msg .= "\r\n";
    $msg .= chunk_split(base64_encode($htmlBody));
    $msg .= "\r\n.\r\n";

    fputs($sock, $msg);
    $resp = trim(smtp_read_response($sock));

    fputs($sock, "QUIT\r\n");
    fclose($sock);

    return (strlen($resp) >= 3 && substr($resp, 0, 3) === '250') ? true : 'Send failed: ' . $resp;
}

/* ── Email template ──────────────────────────────────── */

function esc($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function buildEmailHtml($name, $phone, $email, $message, $needLawyer, $needFinancist, $consentMarketing) {
    $name       = esc($name);
    $phone      = esc($phone);
    $email      = esc($email);
    $messageHtml = nl2br(esc($message));

    $tags = '';
    if ($needLawyer)
        $tags .= '<span style="display:inline-block;padding:5px 11px;margin:3px 6px 3px 0;background:#dcfce7;color:#166534;font-size:13px;font-weight:500;border-radius:6px;">Требуется консультация юриста</span>';
    if ($needFinancist)
        $tags .= '<span style="display:inline-block;padding:5px 11px;margin:3px 6px 3px 0;background:#dbeafe;color:#1e40af;font-size:13px;font-weight:500;border-radius:6px;">Требуется консультация финансиста</span>';
    if ($consentMarketing)
        $tags .= '<span style="display:inline-block;padding:5px 11px;margin:3px 6px 3px 0;background:#f3e8ff;color:#6b21a8;font-size:13px;font-weight:500;border-radius:6px;">Согласие на рекламные рассылки</span>';

    $tagsRow = $tags ? "<tr><td style=\"padding:0 28px 24px;\">$tags</td></tr>" : '';

    return <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Новая заявка</title>
  <style>
    body{margin:0;padding:24px;font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:#f1f5f9;min-height:100vh;box-sizing:border-box;}
    .mail-root{max-width:1000px;width:100%;margin:0 auto;background:#fff;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.07);overflow:hidden;}
    .mail-head{background:#f8fafc;padding:12px 28px;border-bottom:1px solid #e2e8f0;}
    .mail-logo{width:36px;height:36px;background:linear-gradient(135deg,#1e293b 0%,#334155 100%);border-radius:8px;color:#fff;font-size:14px;font-weight:700;line-height:36px;text-align:center;}
    .mail-brand{color:#334155;font-size:15px;font-weight:600;}
    .mail-tag{display:inline-block;padding:4px 10px;background:#e2e8f0;color:#475569;font-size:12px;font-weight:600;border-radius:4px;}
    .mail-contact{padding:20px 28px 24px;color:#0f172a;font-size:15px;line-height:1.5;}
    .mail-label{color:#64748b;font-size:13px;margin-right:12px;}
    .mail-name{color:#0f172a;font-size:15px;font-weight:600;}
    .mail-phone{color:#1e3a5f;font-size:15px;font-weight:600;}
    .mail-email{color:#1e3a5f;font-size:15px;font-weight:600;}
    .mail-message-label{margin:0 0 8px;color:#64748b;font-size:12px;text-transform:uppercase;letter-spacing:0.05em;}
    .mail-message-body{margin:0;color:#0f172a;font-size:15px;line-height:1.6;}
    .mail-footer{padding:16px 28px 24px;border-top:1px solid #e2e8f0;color:#94a3b8;font-size:12px;}
  </style>
</head>
<body>
  <table role="presentation" cellspacing="0" cellpadding="0" class="mail-root">
    <tr>
      <td class="mail-head">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:40px;vertical-align:middle;"><div class="mail-logo">ЭБ</div></td>
            <td style="vertical-align:middle;padding:0 12px;"><span class="mail-brand">Экстренная бухгалтерия</span></td>
            <td style="vertical-align:middle;text-align:right;"><span class="mail-tag">Новая заявка</span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="mail-contact">
        <p style="margin:0 0 10px;"><span class="mail-label">Имя</span><span class="mail-name">$name</span></p>
        <p style="margin:0;"><span class="mail-label">Телефон</span><span class="mail-phone">$phone</span></p>
        <p style="margin:0;"><span class="mail-label">Email</span><span class="mail-email">$email</span></p>
      </td>
    </tr>
    $tagsRow
    <tr>
      <td style="padding:0 28px 28px;">
        <p class="mail-message-label">Сообщение</p>
        <p class="mail-message-body">$messageHtml</p>
      </td>
    </tr>
    <tr>
      <td class="mail-footer">Письмо отправлено автоматически с формы обратной связи.</td>
    </tr>
  </table>
</body>
</html>
HTML;
}

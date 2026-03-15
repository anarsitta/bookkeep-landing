function escapeHtml(str) {
  if (typeof str !== 'string') return ''
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
}

/**
 * @param {{ name: string, phone: string, message: string, needLawyer: boolean, needFinancist: boolean, consentMarketing: boolean }} data
 */
export function buildEmailHtml(data) {
  const esc = (s) => escapeHtml(String(s))
  const name = data.name ? esc(data.name) : '—'
  const phone = data.phone ? esc(data.phone) : '—'
  const messageHtml = data.message ? esc(data.message).replace(/\n/g, '<br>') : '—'

  const tag = (text, bg, color) =>
    `<span style="display:inline-block;padding:5px 11px;margin:3px 6px 3px 0;background:${bg};color:${color};font-size:13px;font-weight:500;border-radius:6px;">${escapeHtml(text)}</span>`
  const tags = []
  if (data.needLawyer) tags.push(tag('Требуется консультация юриста', '#dcfce7', '#166534'))
  if (data.needFinancist) tags.push(tag('Требуется консультация финансиста', '#dbeafe', '#1e40af'))
  if (data.consentMarketing) tags.push(tag('Согласие на рекламные рассылки', '#f3e8ff', '#6b21a8'))
  const tagsRow = tags.length
    ? `<tr><td style="padding:0 28px 24px;">${tags.join('')}</td></tr>`
    : ''

  return `<!DOCTYPE html>
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
        <p style="margin:0 0 10px;"><span class="mail-label">Имя</span><span class="mail-name">${name}</span></p>
        <p style="margin:0;"><span class="mail-label">Телефон</span><span class="mail-phone">${phone}</span></p>
      </td>
    </tr>
    ${tagsRow}
    <tr>
      <td style="padding:0 28px 28px;">
        <p class="mail-message-label">Сообщение</p>
        <p class="mail-message-body">${messageHtml}</p>
      </td>
    </tr>
    <tr>
      <td class="mail-footer">Письмо отправлено автоматически с формы обратной связи.</td>
    </tr>
  </table>
</body>
</html>`
}

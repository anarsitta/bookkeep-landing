<?php
/**
 * Подгружает переменные из .env в getenv() / $_ENV (без Composer).
 */
function loadEnvFile(string $path): void
{
    if (!is_readable($path)) {
        return;
    }
    $raw = file_get_contents($path);
    if ($raw === false) {
        return;
    }
    $lines = preg_split("/\r\n|\n|\r/", $raw);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || (isset($line[0]) && $line[0] === '#')) {
            continue;
        }
        if (!preg_match('/^([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(.*)$/', $line, $m)) {
            continue;
        }
        $key = $m[1];
        $val = trim($m[2]);
        if ($val !== '' && ($val[0] === '"' || $val[0] === "'")) {
            $q = $val[0];
            $val = trim($val, $q . '"\'');
        }
        putenv("$key=$val");
        $_ENV[$key] = $val;
    }
}

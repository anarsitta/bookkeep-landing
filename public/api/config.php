<?php
/**
 * Пароли не храните в этом файле в репозитории.
 * На сервере положите .env в корень сайта (рядом с index.html) с теми же ключами, что и у фронта.
 */
require __DIR__ . '/loadEnv.php';

// 1) корень сайта после сборки: dist/.env
// 2) при необходимости: dist/api/.env
loadEnvFile(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env');
loadEnvFile(__DIR__ . DIRECTORY_SEPARATOR . '.env');

$email    = getenv('OPERATOR_EMAIL') ?: '';
$password = getenv('YANDEX_APP_PASSWORD') ?: '';

return [
    'email'     => trim($email),
    'password'  => trim($password),
    'smtp_host' => trim(getenv('SMTP_HOST') ?: 'smtp.yandex.ru'),
    'smtp_port' => (int) (getenv('SMTP_PORT') ?: 465),
];

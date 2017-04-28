<?php
require_once __DIR__ . '/vendor/autoload.php';

use \Monolog\Handler\StreamHandler;

//monolog
$logger = new \Monolog\Logger('forseti-carga-mg');
$output = "%datetime% %channel%.%level_name% : %message% %context% %extra%\n";
$formatterLine = new \Monolog\Formatter\LineFormatter($output, 'Y-m-d H:i:s', false, true);
$stream = new StreamHandler('php://stdout',\Monolog\Logger::INFO);
$stream->setFormatter($formatterLine);
$logger->pushHandler($stream);

//sentry
$urlSentry = base64_decode('aHR0cHM6Ly9iZTcxNDJlYjFmY2I0ZWE3YWY4ZDBjZDk4NTZjOWU4YzowZDkwMzYwYzA1Nzc0YmVjOThiYmEwMmVjODY4MGQ2ZkBzZW50cnkuaW8vMTYzMDYy');
$client = new Raven_Client($urlSentry);
$raven = new \Monolog\Handler\RavenHandler($client, \Monolog\Logger::NOTICE);//apenas erros serao notificados
$raven->setFormatter($formatterLine);
$logger->pushHandler($raven);

\Monolog\ErrorHandler::register($logger);
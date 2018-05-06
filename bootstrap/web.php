<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('APP_ROOT_PATH', dirname(__DIR__));

$loader = require_once APP_ROOT_PATH . '/../RsyFramework/src/Nimble/autoload.php';
$loader->setPrefix('App', [ APP_ROOT_PATH. '/include' ]);

$bootConfig = [
    'app_path' => APP_ROOT_PATH . '/include',
    'config_path' => APP_ROOT_PATH . '/config',
];

if (!defined('APP_NAME')) {
    define('APP_NAME', 'app');
}

$boot = Nimble\Foundation\Bootstrap::bootstrap($bootConfig);

$app = $boot->application(
    Nimble\Http\Application::class,
    APP_NAME
);

function Config($key)
{
    global $app;
    return $app->configure($key);
}

function App()
{
    global $app;
    return $app;
}

function RecordLog()
{
    static $logger = null;
    if (null === $logger) {
        $logger = Nimble\Log\Logger::globalInstance(Config('log'));
    }
    return $logger;
}

return $app;
<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('APP_CFG_PATH', __DIR__);

function importConfigFile($filePath) {
    $cfgFullFile = APP_CFG_PATH . '/' . $filePath . '.php';
    if (is_file($cfgFullFile)) {
        return include $cfgFullFile;
    }
    return false;
}

return [

    'controller' => [
        'pre' => 'App\\Controllers\\',
    ],

    'router' => [
        'map' => importConfigFile('router'),
        'callback' => function ($app) {
            $act = trim($app->request->get('act'), '/');
            $act = str_replace('_', '/', $act);
            return '/' . $act;
        }
    ],

    'view' => [
        'tpl_path' => APP_ROOT_PATH . '/themes',
        'compile_path' => APP_ROOT_PATH . '/storage/cache/tpl_compile',
    ],
];
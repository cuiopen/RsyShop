<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$adminRouterMap = [
    'login' => 'Admin\\User\\LoginController',
    'checktoken' => 'Admin\\User\\CheckTokenController',
];

return [
    'admin' => $adminRouterMap,
];
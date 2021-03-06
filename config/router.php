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
    'system' => [
        'sitesetting' => 'Admin\\System\\UpdateSiteSettingController',
        'getsitesetting' => 'Admin\\System\\GetSiteSettingController',
        'uploadsetting' => 'Admin\\System\\UpdateUploadSettingController',
        'getuploadsetting' => 'Admin\\System\\GetUploadSettingController',
        'emailsetting' => 'Admin\\System\\EmailSettingController',
        'getemailsetting' => 'Admin\\System\\GetEmailSettingController',
    ],
];

return [
    'admin' => $adminRouterMap,
];
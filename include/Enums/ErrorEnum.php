<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Enums;

class ErrorEnum
{
    const PARAM_ERRYR  = '10001=>参数错误';

    const LOGIN_ERROR  = '30001=>登录错误';
    const LOGIN_STATUS_CHECK_ERROR  = '30002=>登录验证失败';
    const NO_PERMISSION_ERROR = '30003=>无权限访问';
    const LOGIN_EXPIRED_ERROR = '30004=>登录已过期';
}
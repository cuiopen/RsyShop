<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models;

class AdminToken extends BaseModel
{
    protected $table = 'admin_token';

    public static function getTokenByUserId($userId)
    {
        return AdminToken::where('user_id', $userId)->first();
    }

    public static function getTokenByTokenId($token)
    {
        return AdminToken::where('token', $token)->first();
    }
}
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

class AdminUser extends BaseModel
{
    protected $table = 'admin_user';

    public static function getUserInfoByName($username)
    {
        return AdminUser::where('username', $username)->first();
    }

    public static function getUserInfoByUserId($userId)
    {
        return AdminUser::where('user_id', $userId)->first();
    }
}
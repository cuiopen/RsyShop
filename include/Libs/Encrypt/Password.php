<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Encrypt;

class Password
{
    public static function create($md5Password)
    {
        $salt = substr(uniqid(rand(), true), 0, 10);
        $password = md5($md5Password . $salt);

        return [
            'password' => $password,
            'salt' => $salt,
        ];
    }

    public static function check($md5Password, $password, $salt) {
        if (md5($md5Password . $salt) === $password ) {
            return true;
        }
        return false;
    }
}
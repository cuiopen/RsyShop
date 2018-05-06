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

class Rand
{
    const CHAR_COLLECTION = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function string($length = 32)
    {
        if(!is_int($length) || $length < 0) {
            return false;
        }
        $charLen = strlen(self::CHAR_COLLECTION);
        $randStr = '';
        for($i = $length; $i > 0; $i--) {
            $randStr .= self::CHAR_COLLECTION[rand(0, $charLen - 1)];
        }

        return $randStr;
    }
}
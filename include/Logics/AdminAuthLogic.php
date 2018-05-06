<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Logics;

use App\Exceptions\AppException;
use App\Libs\Encrypt\Password;
use App\Libs\Encrypt\Rand;
use App\Models\AdminUser;
use App\Models\AdminToken;

class AdminAuthLogic
{
    public function login($username, $md5Pssword)
    {
        $userInfo = AdminUser::getUserInfoByName($username);
        if (!$userInfo) {
            throw new AppException("用户不存在");
        }
        $pwdStatus = Password::check($md5Pssword, $userInfo['password'], $userInfo['salt']);
        if (!$pwdStatus) {
            throw new AppException("用户密码错误");
        }
        return [
            'user_id' => $userInfo['user_id'],
            'username' => $userInfo['username'],
        ];
    }

    public function userToken($userId)
    {
        $expireTime = time() +  86400 * 30;
        try {
            $userToken = AdminToken::getTokenByUserId($userId);
            if (!$userToken) {
                $newToken = Rand::string(40);
                $adminToken = new AdminToken();
                $adminToken->user_id = $userId;
                $adminToken->token = $newToken;
                $adminToken->ctime = time();
                $adminToken->etime = $expireTime;
                $adminToken->save();
            } elseif ($userToken['etime'] < time()) {
                $newToken = Rand::string(40);
                AdminToken::data(['token' => $newToken, 'etime' => $expireTime])->where('user_id', $userId)->update();
            } else {
                $newToken = $userToken['token'];
            }
        } catch (Exception $e) {
            throw new AppException("Token生成失败");
        }
        return $newToken;
    }

    public function checkToken($token)
    {
        $userToken = AdminToken::getTokenByTokenId($token);
        if (!$userToken) {
            throw new AppException("token无效");
        }
        if (time() > $userToken['etime']) {
            throw new AppException("Token已经失效");
        }
        $userInfo = AdminUser::getUserInfoByUserId($userToken['user_id']);
        return [
            'user_id' => $userInfo['user_id'],
            'username' => $userInfo['username'],
            'token' => $token,
            'ctime' => $userToken['ctime'],
            'etime' => $userToken['etime'],
        ];
    }
}
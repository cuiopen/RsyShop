<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controllers\Admin\User;

use App\Controllers\Admin\Controller;
use App\Logics\AdminAuthLogic;
use App\Exceptions\AppException;
use App\Enums\ErrorEnum;

class LoginController extends Controller
{
    protected $checkAccessAuth = false;

    protected function init()
    {
        $this->userAuthLogic = new AdminAuthLogic();
    }

    public function request($request)
    {
        $this->username = $request->post('username');
        $this->password = $request->post('password');
        $validReg = [
            ['username', $this->username, 'require'],
            ['password', $this->password, 'require'],
        ];
        $validMsg = [
            'require' => '用户名或密码不能为空',
        ];
        return $this->validatorStatus($validReg, $validMsg);
    }

    public function main()
    {
        try {
            $userInfo = $this->userAuthLogic->login($this->username, $this->password);
            $token = $this->userAuthLogic->userToken($userInfo['user_id']);
        } catch (AppException $e) {
            $this->errorCode = ErrorEnum::LOGIN_ERROR;
            $this->errorMessage = $e->getMessage();
            return false;
        }

        $this->respData['user_id'] = $userInfo['user_id'];
        $this->respData['username'] = $userInfo['username'];
        $this->respData['token'] = $token;
    }
}
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

class CheckTokenController extends Controller
{
    private $token = '';

    protected $checkAccessAuth = false;

    protected function init()
    {
        $this->adminAuthLogic = new AdminAuthLogic();
    }

    public function request($request)
    {
        $this->token = $request->post('token');
        $validReg = [
            ['token', $this->token, 'require'],
        ];
        return $this->validatorStatus($validReg);
    }

    public function main()
    {
        try {
            $userInfo = $this->adminAuthLogic->checkToken($this->token);
        } catch (AppException $e) {
            $this->errorCode = ErrorEnum::LOGIN_STATUS_CHECK_ERROR;
            $this->errorMessage = $e->getMessage();
            return false;
        }
        if ($userInfo['etime'] < time()) {
            $this->errorCode = ErrorEnum::LOGIN_STATUS_CHECK_ERROR;
            $this->errorMessage = 'token失效，请重新登录';
            return false;
        }
        $this->respData['user_id'] = $userInfo['user_id'];
        $this->respData['username'] = $userInfo['username'];
        $this->respData['token'] = $userInfo['token'];
        $this->respData['ctime'] = $userInfo['ctime'];
        $this->respData['etime'] = $userInfo['etime'];
        $this->respData['priv'] = [
            'system', 
                'systemSetting', 
                    'systemSettingSite', 'systemSettingUpload', 'systemSettingEmail',
                'systemPay',
                    'systemPayType', 'systemSettingArea', 'systemSettingDistrict', 'systemPayExpress', 'systemPayFare', 
                'systemAdmin',
                    'systemAdminList', 'systemAdminRole', 'systemAdminLog',
                'systemUpdate',

            'goods',
            'goodsManage',
            'goodsManageList',
        ];
    }
}
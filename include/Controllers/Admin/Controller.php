<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controllers\Admin;

use App\Controllers\Controller as BaseController;
use App\Logics\AdminAuthLogic;
use App\Enums\ErrorEnum;

class Controller extends BaseController
{
    protected $checkAccessAuth = true;

    protected function initialize()
    {
        if ($this->checkAccessAuth && !$this->checkAuth($this->request->request('token'))) {
            return false;
        }
        if (method_exists($this, 'init')) {
            $this->init();
        }
        
        $requestCheckStatus = true;
        if (method_exists($this, 'request')) {
            $requestCheckStatus = $this->request($this->request);
        }
        if (false !== $requestCheckStatus && method_exists($this, 'main')) {
            $this->main();
        }
    }

    protected function checkAuth($token)
    {
        $adminAuth = new AdminAuthLogic();
        $userInfo = $adminAuth->checkToken($token);
        if (!$userInfo) {
            $this->errorCode = ErrorEnum::LOGIN_STATUS_CHECK_ERROR;
            return false;
        }
        if ($userInfo['etime'] < time()) {
            $this->errorCode = ErrorEnum::LOGIN_EXPIRED_ERROR;
            return false;
        }

        return true;
    }

    public function response()
    {
        if ($this->errorCode) {
            return $this->outputErrorJson($this->errorCode, $this->errorMessage);
        }
        return $this->outputJson($this->respData);
    }
}
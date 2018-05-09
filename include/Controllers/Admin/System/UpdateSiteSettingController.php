<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controllers\Admin\System;

use App\Controllers\Admin\Controller;
use App\Logics\CommonSettingLogic;
use App\Enums\ErrorEnum;

class UpdateSiteSettingController extends Controller
{
    protected function init()
    {
        $this->commonSettingLogic = new CommonSettingLogic();
    }

    public function request($request)
    {
        $this->updateData = $request->post('data');
        $filterKeys = [];
        foreach ($this->commonSettingLogic->siteSettingKeys as $field) {
            $filterKeys[$field] = true;
        }
        if (array_diff_key($this->updateData, $filterKeys)) {
            $this->errorCode = ErrorEnum::PARAM_ERRYR;
            return false;
        }
    }

    public function main()
    {
        $this->commonSettingLogic->updateSetting($this->updateData);
    }
}
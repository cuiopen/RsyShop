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

class GetUploadSettingController extends Controller
{
    protected function init()
    {
        $this->commonSettingLogic = new CommonSettingLogic();
    }

    public function main()
    {
        $arrSettingValues = [];
        $arrValues = $this->commonSettingLogic->getSetting($this->commonSettingLogic->uploadSettingKeys);
        if ($arrValues) {
            foreach ($arrValues as $val) {
                $arrSettingValues[$val['key']] = $val['value'];
            }
        }

        $this->respData = $arrSettingValues;
    }
}
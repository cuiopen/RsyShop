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

use App\Models\CommonSetting;

class CommonSettingLogic
{
    public $siteSettingKeys = [
        'sitename', 'keyword', 'description', 'timezone', 'telphone', 'address', 
        'code', 'icp', 'copyright', 'siteswitch', 'closedreason',
    ];

    public $uploadSettingKeys = [
        'picmaxsize', 'picallowext', 
    ];

    public $emailSettingKeys = [
        'smtpserver', 'smtpport', 'smtpfrom', 'smtpuser', 'smtppass', 'smtptest', 
    ];

    public function updateSetting(array $updateData)
    {
        $arrKeys = [];
        foreach ($updateData as $key => $val) {
            $arrKeys[] = $key;
        }
        if ($arrKeys) {
            CommonSetting::flushKeys($arrKeys);
        }
        CommonSetting::insertKeys($updateData);
    }

    public function getSetting(array $fields)
    {
        return CommonSetting::getKeyValues($fields);
    }
}
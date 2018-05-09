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

class CommonSetting extends BaseModel
{
    protected $table = 'common_setting';

    public static function flushKeys(array $keys)
    {
        return CommonSetting::whereIn('key', $keys)->delete();
    }

    public static function insertKeys(array $data)
    {
        foreach ($data as $key => $val) {
            $model = new CommonSetting();
            $model->key = $key;
            $model->value = $val;
            $model->ctime = time();
            $model->save();
        }
    }

    public static function getKeyValues(array $keys)
    {
        return CommonSetting::whereIn('key', $keys)->all();
    }
}

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

use Nimble\Mysql\Model;

class BaseModel extends Model
{
    protected $config;

    protected $tbPrefix = '';

    public function __construct()
    {
        $dbConfig = Config('database.connection');
        $this->config = $dbConfig;
        $this->config['charset'] = 'utf8';
        $this->tbPrefix = $dbConfig['tb_prefix'];

        parent::__construct();
    }
}
<?php

/*
 * This file is part of the RsyShop package
 *
 * (c) Dreamans <dreamans@rsycoder.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controllers;

use Nimble\View\View;
use Nimble\Validator\Validator;

class Controller
{
    protected $container;

    protected $request;

    protected $response;

    protected $view;

    public function __construct($container)
    {
        $this->container = $container;
        $this->request = $container->request;
        $this->response = $container->response;

        $this->view = View::create(Config('app.view.tpl_path'), Config('app.view.compile_path'));

        if (method_exists($this, 'initialize')) {
            $this->initialize();
        }

        $this->enableCrossRequest();
    }

    private function enableCrossRequest()
    {
        $origin = $this->request->header('origin');
        $this->setHeader('Access-Control-Allow-Origin', $origin);
        $this->setHeader('Access-Control-Allow-Credentials', 'true');
        $this->setHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, X-Requested-With, Cache-Control, Authorization');
        $this->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    }

    protected function view($tpl, array $vars = [])
    {
        return $this->view->display($tpl, $vars);
    }

    protected function validator(array $validReg, array $validMsg = [])
    {
        if (!isset($validMsg['require'])) {
            $validMsg['require'] = ':attribute can not be empty';
        }
        return Validator::make($validReg, $validMsg);
    }

    protected function validatorStatus(array $validReg, array $validMsg = [])
    {
        $valid = $this->validator($validReg, $validMsg);
        if (true != $valid->validate) {
            return false;
        }
        return true;
    }

    protected function setHeader($key, $val)
    {
        $this->response->setHeader($key, $val);
    }
}
<?php

namespace modules\Cli\controllers;

use Yaf\Controller_Abstract;

class IndexController extends Controller_Abstract
{
    public function aboutAction()
    {
        echo 'Yet another YAF framework';
    }
}
<?php

namespace modules\Cli\controllers;

use Yaf\Controller_Abstract;

class AboutController extends Controller_Abstract
{
    public function indexAction()
    {
        echo 'Yet another YAF framework';
    }
}

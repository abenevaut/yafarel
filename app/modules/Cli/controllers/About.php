<?php

use Yaf\Controller_Abstract;

class AboutController extends Controller_Abstract
{
    public function indexAction()
    {
        $this->getView()->content = 'Yet another YAF framework';
    }
}

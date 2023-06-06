<?php

use Yaf\Controller_Abstract;

class AboutController extends Controller_Abstract
{
    public function handleAction()
    {
        $content = 'Yet another YAF framework';

        Console::log($content, 'green', true);
        Console::log($content, 'yellow', true);
        Console::log($content, 'red', true);
        Console::bell();
    }
}

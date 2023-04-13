<?php

use App\Services\Log;
use Yaf\Controller_Abstract;

class IndexController extends Controller_Abstract
{
    public function indexAction()
    {
        $this->getView()->content = 'Hello World';

        Log::debug("View content: {$this->getView()->content}");
    }
}

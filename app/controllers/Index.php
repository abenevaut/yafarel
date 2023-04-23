<?php

use App\Facades\Log;
use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->content = 'Hello World';

        Log::debug("View content: {$this->getView()->content}");
    }

    public function argumentValidatedAction($id, $name)
    {
        // /argument/123001/stringhere

        $this->getView()->id = $id;
        $this->getView()->name = $name;

        Log::debug("View content: {$this->getView()->content}");
    }
}

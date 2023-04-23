<?php

use App\Facades\Log;
use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->content = 'Hello World';

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }

    public function argumentValidatedAction($id, $name)
    {
        // /argument/123001/anto234ine

        $this->getView()->id = $id;
        $this->getView()->name = $name;

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }
}

<?php

use App\Services\Log;
use Yaf\Controller_Abstract;

class IndexController extends Controller_Abstract
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
        // https://stylix.primeum.local/yaf-framework/argument/123001/anto234ine

        $this->getView()->id = $id;
        $this->getView()->name = $name;

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }
}

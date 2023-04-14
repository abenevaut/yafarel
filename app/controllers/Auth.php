<?php

use App\Services\Log;
use Yaf\Controller_Abstract;

class AuthController extends Controller_Abstract
{
    public function loginAction()
    {
        $this->getView()->content = 'Login';

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }

    public function logAction()
    {
        $this->getView()->content = 'Log';

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }
}

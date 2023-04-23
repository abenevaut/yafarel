<?php

use App\Facades\Log;
use App\Infrastructure\ControllerAbstract;

class AuthController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->content = 'LoginForm';

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }

    public function loginAction()
    {
        $username = $this->getRequest()->getPost('username');
        $password = $this->getRequest()->getPost('password');

        $this->getView()->content = 'Login';
        $this->getView()->username = $username;
        $this->getView()->password = $password;

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }

    public function logoutAction()
    {
        $this->getView()->content = 'Logout';

        Log::debug("View content: {$this->getView()->content}", [
            'class' => __CLASS__,
            'method' => __METHOD__,
        ]);
    }
}

<?php

namespace App\Exceptions\Http;

use Yaf\View_Interface;

class HttpException extends \Exception
{
    public function render(View_Interface $view): string
    {
        $viewTemplate = $this->getCode() ?: 500;

        return $view->render("error/{$viewTemplate}.phtml", [
            'message' => $this->getMessage(),
        ]);
    }
}

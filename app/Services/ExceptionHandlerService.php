<?php

namespace App\Services;

use NunoMaduro\Collision\Handler as ConsoleHandler;
use Whoops\{
    Run,
    Handler\JsonResponseHandler as JsonHandler,
    Handler\PrettyPageHandler as HtmlHandler
};

class ExceptionHandlerService
{
    protected bool $isViewableException = false;

    public function __construct(
        protected bool $isProduction,
        protected bool $isCliRequest = false,
        protected bool $isXmlHttpRequest = false,
    ) {
        $this->isViewableException = !$isCliRequest || !$isXmlHttpRequest;
    }

    public function report(\Throwable $exception): string
    {
        \App\Facades\Log::emergency($exception);

        return $this->viewableException($exception);
    }

    protected function exceptionHandler(): Run
    {
        $viewableHandler = $this->isXmlHttpRequest
            ? JsonHandler::class
            : HtmlHandler::class;

        if ($this->isCliRequest) {
            $viewableHandler = ConsoleHandler::class;
        }

        $exceptionHandler = new Run();
        $exceptionHandler->allowQuit(false);
        $exceptionHandler->writeToOutput(false);
        return $exceptionHandler->pushHandler(new $viewableHandler());
    }

    private function handleException(\Throwable $exception): string
    {
        switch ($exception->getCode()) {
            case 404:
                $html = $this
                    ->getView()
                    ->render('error/404.phtml', [
                        'message' => $exception->getMessage(),
                    ]);
                break;
            default:
                $html = $this
                    ->getView()
                    ->render('error/500.phtml', [
                        'message' => $exception->getMessage(),
                    ]);
        }

        return $html;
    }

    private function viewableException(\Throwable $exception): string
    {
        $handler = $this;
        if (!$this->isViewableException || !$this->isProduction) {
            $handler = $this->exceptionHandler();
        }

        return $handler->handleException($exception);
    }
}

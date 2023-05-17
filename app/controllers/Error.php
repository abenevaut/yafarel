<?php

use App\Infrastructure\ControllerAbstract;
use NunoMaduro\Collision\Handler as ConsoleHandler;
use Whoops\{
    Run,
    Handler\JsonResponseHandler as JsonHandler,
    Handler\PrettyPageHandler as HtmlHandler
};

class ErrorController extends ControllerAbstract
{
    public function errorAction(\Throwable $exception)
    {
        $this->logException($exception);

        $isViewableException = !$this->getRequest()->isCli()
            || !$this->getRequest()->isXmlHttpRequest();

        $handler = $this;
        if (!$isViewableException || !Environment::isProduction()) {
            $handler = $this->exceptionHandler();
        }

        $this->getResponse()->setBody($handler->handleException($exception));

        return true;
    }

    private function logException(\Throwable $exception): void
    {
        switch ($exception->getCode()) {
            case 404:
                \App\Facades\Log::notice($exception);
                break;
            case 500:
            default:
                \App\Facades\Log::emergency($exception);
        }
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

    private function exceptionHandler(): Run
    {
        $viewableHandler = $this->getRequest()->isXmlHttpRequest()
            ? JsonHandler::class
            : HtmlHandler::class;

        if ($this->getRequest()->isCli()) {
            $viewableHandler = ConsoleHandler::class;
        }

        $exceptionHandler = new Run();
        $exceptionHandler->allowQuit(false);
        $exceptionHandler->writeToOutput(false);
        return $exceptionHandler->pushHandler(new $viewableHandler());
    }
}

<?php

use App\Infrastructure\ControllerAbstract;
use App\Exceptions\Http\HttpException;
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
        $isViewableException = !$this->getRequest()->isCli()
            || !$this->getRequest()->isXmlHttpRequest();

        $handler = $this;
        if (true && (!$isViewableException || !Environment::isProduction())) {
            $handler = $this->getExceptionHandler();
        }

        $this->getResponse()->setBody($handler->handleException($exception));

        return false;
    }

    private function handleException(\Throwable $exception): string
    {
        $this->getResponse()->setHeader('Status', $exception->getCode() ?: 500);

        if (!($exception instanceof HttpException)) {
            $exception = new HttpException($exception->getMessage(), 500, $exception);
        }

        return $exception->render($this->getView());
    }

    private function getExceptionHandler(): Run
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

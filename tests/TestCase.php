<?php

namespace Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Yaf\Application;
use Yaf\Registry;
use Yaf\View\Simple as ViewSimple;

define('PROJECT_PATH',  dirname(dirname(__FILE__)));

class TestCase extends PHPUnitTestCase implements YafTestCase
{
    use YafUnit;

    public static ?Application $app = null;
    public static ?ViewSimple $viewEngine = null;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Hold time.
        Carbon::setTestNow();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->createApplication();
    }

    protected function createApplication(): self
    {
        if (!Registry::get('ApplicationInit')) {
            self::$app = new Application(PROJECT_PATH . '/app.ini');
            self::$viewEngine = new ViewSimple(PROJECT_PATH . '/app/views');

            $this->getApplication()->bootstrap();
            $this->getApplication()->getDispatcher()->autoRender(false);
            $this->getApplication()->getDispatcher()->flushInstantly(false);
            $this->getApplication()->getDispatcher()->returnResponse(true);
            $this->getApplication()->getDispatcher()->setView($this->getView());

            Registry::set( 'ApplicationInit', true );
        }

        return $this;
    }

    protected function getApplication(): Application
    {
        return self::$app;
    }

    protected function getView(): ViewSimple
    {
        return self::$viewEngine;
    }
}

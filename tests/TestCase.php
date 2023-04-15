<?php

namespace Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

define('PROJECT_PATH',  dirname(dirname(__FILE__)));

class TestCase extends PHPUnitTestCase implements YafTestCase
{
    use YafUnit;

    public function __construct($name = null)
    {
        parent::__construct($name);

        // Hold time.
        Carbon::setTestNow();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->createApplication(PROJECT_PATH . '/app.ini', PROJECT_PATH . '/app/views');
    }
}

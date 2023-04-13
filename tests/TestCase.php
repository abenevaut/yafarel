<?php

namespace Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Tests\YafTestCase;

define('PROJECT_PATH',  dirname(dirname(__FILE__)));

class TestCase extends PHPUnitTestCase implements YafTestCase
{
    use YafUnit;

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
}

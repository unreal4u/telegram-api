<?php

namespace tests\InternalFunctionality;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;

class DummyLoggerTest extends TestCase
{
    /**
     * @var DummyLogger
     */
    private $dummyLogger;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->dummyLogger = new DummyLogger();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->dummyLogger = null;
        parent::tearDown();
    }

    public function testEmergency()
    {
        $result = $this->dummyLogger->emergency('Hello');
        $this->assertFalse($result);
    }

    public function testAlert()
    {
        $result = $this->dummyLogger->alert('Hello');
        $this->assertFalse($result);
    }

    public function testCritical()
    {
        $result = $this->dummyLogger->critical('Hello');
        $this->assertFalse($result);
    }

    public function testError()
    {
        $result = $this->dummyLogger->error('Hello');
        $this->assertFalse($result);
    }

    public function testWarning()
    {
        $result = $this->dummyLogger->warning('Hello');
        $this->assertFalse($result);
    }

    public function testNotice()
    {
        $result = $this->dummyLogger->notice('Hello');
        $this->assertFalse($result);
    }

    public function testInfo()
    {
        $result = $this->dummyLogger->info('Hello');
        $this->assertFalse($result);
    }

    public function testDebug()
    {
        $result = $this->dummyLogger->debug('Hello');
        $this->assertFalse($result);
    }

    public function testLog()
    {
        $result = $this->dummyLogger->log(100, 'Hello');
        $this->assertFalse($result);
    }
}

<?php

use tests\MockTgLog;
use unreal4u\Telegram\Methods\GetMe;

class TgLogTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tgLog = null;
        parent::tearDown();
    }

    public function test_getMe()
    {
        $getMe = new GetMe();

        $result = $this->tgLog->performApiRequest($getMe);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\User', $result);
    }
}

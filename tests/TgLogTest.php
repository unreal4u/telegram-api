<?php

namespace unreal4u\TelegramAPI\tests;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class TgLogTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        $this->tgLog = null;
    }

    public function testComposeApiMethodUrl()
    {
        $this->assertSame(
            'https://api.telegram.org/botTEST-TEST/GetMe',
            $this->tgLog->composeApiMethodUrl(new GetMe())
        );
    }

    /*public function testBuildMultipartFormData(array $data, string $fileKeyName, $stream = null, array $expected = [])
    {
        $call = new \ReflectionMethod('unreal4u\\TelegramAPI\\TgLog', 'buildMultipartFormData');
        $call->setAccessible(true);
        $result = $call->invokeArgs(new \unreal4u\TelegramAPI\TgLog('TEST-TEST'), [$data, $fileKeyName, $stream]);
        $this->assertEquals($expected, $result);
    }*/
}

<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;

class GetMeTest extends TestCase
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

    public function testGetMe()
    {
        $getMe = new GetMe();

        $result = $this->tgLog->performApiRequest($getMe);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result);
        $this->assertNotEmpty($result->first_name);
        $this->assertNotEmpty($result->username);

        $this->assertStringEndsWith('Bot', $result->username);
    }

    public function testGetMeInvalidBotToken()
    {
        $getMe = new GetMe();

        $this->tgLog->specificTest = 'invalidBotToken';
        $this->tgLog->mockException = true;

        try {
            $this->tgLog->performApiRequest($getMe);
        } catch (MockClientException $e) {
            $this->assertInstanceOf('\\stdClass', $e->decodedResponse);
            $this->assertEquals(401, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }
}

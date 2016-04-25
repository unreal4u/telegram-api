<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockClientException;
use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;

class GetMeTest extends \PHPUnit_Framework_TestCase
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

    /**
     * Asserts that the GetMe method ALWAYS load in a user type
     */
    public function testBindToObjectType()
    {
        $type = GetMe::bindToObjectType();
        $this->assertEquals('User', $type);
    }

    /**
     * @depends testBindToObjectType
     */
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
            $this->setExpectedException('tests\\Mock\\MockClientException');
            throw $e;
        }
    }
}

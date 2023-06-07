<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class GetMeTest extends TestCase
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

    public function testGetMe()
    {
        $getMe = new GetMe();

        $promise = $this->tgLog->performApiRequest($getMe);

        $promise->then(function (User $result) {
            $this->assertInstanceOf(User::class, $result);
            $this->assertNotEmpty($result->first_name);
            $this->assertNotEmpty($result->username);

            $this->assertStringEndsWith('Bot', $result->username);
        });
    }

    public function testGetMeInvalidBotToken()
    {
        $this->tgLog->specificTest = 'invalidBotToken';
        $this->tgLog->mockException = true;

        try {
            $this->tgLog->performApiRequest(new GetMe());
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(401, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }
}

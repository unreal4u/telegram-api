<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\SetWebhook;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class SetWebhookTest extends TestCase
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

    public function testMandatoryFields()
    {
        $this->expectExceptionMessage("url");
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\MissingMandatoryField::class);
        $setWebhook = new SetWebhook();
        $this->tgLog->performApiRequest($setWebhook);
    }

    public function testSetWebhook()
    {
        $setWebhook = new SetWebhook();
        $setWebhook->url = 'https://example.com/';

        $promise = $this->tgLog->performApiRequest($setWebhook);

        $promise->then(function (ResultBoolean $result) {
            $this->assertInstanceOf(ResultBoolean::class, $result);
            $this->assertTrue($result->data);
        });
    }

    public function testUnsetWebhook()
    {
        $this->tgLog->specificTest = 'unset';

        $setWebhook = new SetWebhook();
        $setWebhook->url = '';

        $promise = $this->tgLog->performApiRequest($setWebhook);

        $promise->then(function (ResultBoolean $result) {
            $this->assertInstanceOf(ResultBoolean::class, $result);
            $this->assertTrue($result->data);
        });
    }
}

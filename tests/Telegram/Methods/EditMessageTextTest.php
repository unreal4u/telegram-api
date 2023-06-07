<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessageText;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class EditMessageTextTest extends TestCase
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

    public function testMissingMandatoryExportField()
    {
        $this->expectExceptionMessage("chat_id");
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\MissingMandatoryField::class);
        $editMessageText = new EditMessageText();
        $editMessageText->export();
    }

    public function testMissingMandatoryTextField()
    {
        $this->expectExceptionMessage("text");
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\MissingMandatoryField::class);
        $editMessageText = new EditMessageText();
        $editMessageText->inline_message_id = 12341234;
        $editMessageText->export();
    }

    public function testMissingMandatoryMessageIdField()
    {
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\MissingMandatoryField::class);
        $this->expectExceptionMessage("message_id");
        $editMessageText = new EditMessageText();
        $editMessageText->chat_id = 12341234;
        $editMessageText->text = 'Hello world';
        $editMessageText->export();
    }

    public function testMissingMandatoryInlineMessageIdField()
    {
        $editMessageText = new EditMessageText();

        $this->assertContains('inline_message_id', $editMessageText->getMandatoryFields());
    }
}

<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessage\Caption;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class EditMessageCaptionTest extends TestCase
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
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage chat_id
     */
    public function testMissingMandatoryExportField()
    {
        $editMessageText = new Caption();
        $editMessageText->export();
    }

    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage message_id
     */
    public function testMissingMandatoryMessageIdField()
    {
        $editMessageText = new Caption();
        $editMessageText->chat_id = 12341234;
        $editMessageText->caption = 'Hello world';
        $editMessageText->export();
    }

    public function testMissingMandatoryInlineMessageIdField()
    {
        $editMessageText = new Caption();

        $this->assertContains('inline_message_id', $editMessageText->getMandatoryFields());
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new Caption();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('editMessageCaption', $return);
    }

    public function testHandleResponseSuccessful()
    {
        // TODO
        $this->assertTrue(true);
    }

    public function testHandleNonSuccessfulResponse()
    {
        // TODO
        $this->assertTrue(true);
    }
}

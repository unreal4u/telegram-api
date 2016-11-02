<?php

namespace tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendDocument;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class SendDocumentTest extends TestCase
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

    public function testSendDocument()
    {
        $sendDocument = new SendDocument();
        $sendDocument->chat_id = 12341234;
        $sendDocument->document = new InputFile(__FILE__);

        $result = $this->tgLog->performApiRequest($sendDocument);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(18, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendDocument->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452640889, $result->date);
        $this->assertNull($result->sticker);
        $this->assertNull($result->voice);
        $this->assertNull($result->video);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Document', $result->document);
        $this->assertEquals('XXX-YYY-ZZZ-01', $result->document->file_id);
        $this->assertNull($result->document->thumb);
    }
}

<?php

namespace tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendSticker;

class SendStickerTest extends TestCase
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

    public function testSendSticker()
    {
        $sendSticker = new SendSticker();
        $sendSticker->chat_id = 12341234;
        $sendSticker->sticker = 'BQADBAADsgUAApv7sgABW0IQT2B3WekC';

        $result = $this->tgLog->performApiRequest($sendSticker);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(17, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendSticker->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452640389, $result->date);
        $this->assertNull($result->document);
        $this->assertNull($result->voice);
        $this->assertNull($result->video);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Sticker', $result->sticker);
        $this->assertEquals($sendSticker->sticker, $result->sticker->file_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\PhotoSize', $result->sticker->thumb);
        $this->assertEquals(128, $result->sticker->thumb->height);
    }
}

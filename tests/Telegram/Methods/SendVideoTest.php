<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Video;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendVideo;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\User;

class SendVideoTest extends TestCase
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

    public function testSendVideo()
    {
        $sendVideo = new SendVideo();
        $sendVideo->chat_id = 12341234;
        $sendVideo->video = new InputFile('examples/binary-test-data/demo-video.mp4');
        $sendVideo->caption = 'Example of a video file sent with Telegram';

        /** @var Message $result */
        $result = $this->tgLog->performApiRequest($sendVideo);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertEquals(20, $result->message_id);
        $this->assertInstanceOf(User::class, $result->from);
        $this->assertInstanceOf(Chat::class, $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendVideo->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452641851, $result->date);
        $this->assertNull($result->document);
        $this->assertNull($result->voice);
        $this->assertNull($result->audio);

        $this->assertInstanceOf(Video::class, $result->video);
        $this->assertEquals('XXX-YYY-ZZZ-01', $result->video->file_id);
        $this->assertEquals($sendVideo->caption, $result->caption);
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new SendVideo();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('sendVideo', $return);
    }
}

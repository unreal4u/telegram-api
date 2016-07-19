<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendVideo;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class SendVideoTest extends \PHPUnit_Framework_TestCase
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

        $result = $this->tgLog->performApiRequest($sendVideo);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(20, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendVideo->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452641851, $result->date);
        $this->assertNull($result->document);
        $this->assertNull($result->voice);
        $this->assertNull($result->audio);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Video', $result->video);
        $this->assertEquals('XXX-YYY-ZZZ-01', $result->video->file_id);
        $this->assertEquals($sendVideo->caption, $result->caption);
    }
}

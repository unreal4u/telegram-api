<?php

namespace tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendAudio;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class SendAudioTest extends TestCase
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

    public function testSendAudio()
    {
        $sendAudio = new SendAudio();
        $sendAudio->chat_id = 12341234;
        $sendAudio->audio = new InputFile('examples/binary-test-data/ICQ-uh-oh.mp3');
        $sendAudio->title = 'The famous ICQ new message alert';

        $result = $this->tgLog->performApiRequest($sendAudio);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(16, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(12345678, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendAudio->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452635645, $result->date);
        $this->assertNull($result->document);
        $this->assertNull($result->voice);
        $this->assertNull($result->video);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Audio', $result->audio);
        $this->assertEquals('XXX-YYY-ZZZ-01', $result->audio->file_id);
        $this->assertEquals($sendAudio->title, $result->audio->title);
    }
}

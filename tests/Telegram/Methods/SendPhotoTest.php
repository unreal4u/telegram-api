<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\SendPhoto;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class SendPhotoTest extends TestCase
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

    public function testSendPhoto()
    {
        $sendPhoto = new SendPhoto();
        $sendPhoto->chat_id = 12341234;
        $sendPhoto->photo = new InputFile('examples/binary-test-data/demo-photo.jpg');
        $sendPhoto->caption = 'Not sure if sending image or image not arriving';

        /** @var Message $result */
        $promise = $this->tgLog->performApiRequest($sendPhoto);

        $promise->then(function (Message $result) use ($sendPhoto) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(19, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(12345678, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendPhoto->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452641442, $result->date);
            $this->assertNull($result->document);
            $this->assertNull($result->voice);
            $this->assertNull($result->video);
            $this->assertNull($result->audio);

            $this->assertCount(3, $result->photo);
            $this->assertContainsOnlyInstancesOf('unreal4u\\TelegramAPI\\Telegram\\Types\\PhotoSize', $result->photo);
            $i = 1;
            foreach ($result->photo as $photo) {
                $this->assertEquals(sprintf('XXX-YYY-ZZZ-0%d', $i), $photo->file_id);
                ++$i;
            }
        });
    }
}

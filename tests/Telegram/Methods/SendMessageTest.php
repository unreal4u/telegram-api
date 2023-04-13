<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\ReplyKeyboardMarkup;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class SendMessageTest extends TestCase
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

    public function testSendMessage()
    {
        $sendMessage = new SendMessage();
        $sendMessage->chat_id = 12341234;
        $sendMessage->text = 'Hello world';

        $promise = $this->tgLog->performApiRequest($sendMessage);

        $promise->then(function (Message $result) use ($sendMessage) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(14, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(123456789, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendMessage->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452254253, $result->date);
            $this->assertNull($result->audio);

            $this->assertEquals($sendMessage->text, $result->text);
        });
    }

    /**
     * Keyboard options don't give anything special back, those are just commands to the user. Test this condition.
     *
     * @depends testSendMessage
     */
    public function testSendMessageWithKeyboardOptions()
    {
        $sendMessage = new SendMessage();
        $sendMessage->chat_id = 12341234;
        $sendMessage->text = 'Hello world';
        $sendMessage->reply_markup = new ReplyKeyboardMarkup();
        $sendMessage->reply_markup->keyboard = [['Yes', 'No']];

        // Important assert: ensure we send a serialized object to Telegram
        $this->assertJsonStringEqualsJsonFile(
            'tests/Mock/MockData/SendMessage-replyKeyboardMarkup.json',
            json_encode($sendMessage->reply_markup)
        );

        $promise = $this->tgLog->performApiRequest($sendMessage);

        $promise->then(function (Message $result) use ($sendMessage) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertEquals(14, $result->message_id);
            $this->assertInstanceOf(User::class, $result->from);
            $this->assertInstanceOf(Chat::class, $result->chat);
            $this->assertEquals(123456789, $result->from->id);
            $this->assertEquals('unreal4uBot', $result->from->username);
            $this->assertEquals($sendMessage->chat_id, $result->chat->id);
            $this->assertEquals('unreal4u', $result->chat->username);

            $this->assertEquals(1452254253, $result->date);
            $this->assertNull($result->audio);

            $this->assertEquals($sendMessage->text, $result->text);
        });
    }

    public function testSendMessageChatNotFound()
    {
        $this->tgLog->specificTest = 'chatNotFound';
        $this->tgLog->mockException = true;

        $sendMessage = new SendMessage();
        $sendMessage->chat_id = 0;
        $sendMessage->text = 'Hello world';

        try {
            $this->tgLog->performApiRequest($sendMessage);
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(400, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }

    public function testSendIncompleteMessage()
    {
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\MissingMandatoryField::class);
        $this->expectExceptionMessage("chat_id");
        $sendMessage = new SendMessage();
        $sendMessage->text = 'Hello world!';

        $this->tgLog->performApiRequest($sendMessage);
    }

    public function testKickedBot()
    {
        $this->tgLog->specificTest = 'botWasKicked';
        $this->tgLog->mockException = true;

        $sendMessage = new SendMessage();
        $sendMessage->text = 'Hello world!';
        $sendMessage->chat_id = 0;

        try {
            $this->tgLog->performApiRequest($sendMessage);
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(403, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }
}

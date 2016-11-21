<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\Telegram\Types\ReplyKeyboardMarkup;

class SendMessageTest extends TestCase
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

    public function testSendMessage()
    {
        $sendMessage = new SendMessage();
        $sendMessage->chat_id = 12341234;
        $sendMessage->text = 'Hello world';
        $result = $this->tgLog->performApiRequest($sendMessage);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(14, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(123456789, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendMessage->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452254253, $result->date);
        $this->assertNull($result->audio);

        $this->assertEquals($sendMessage->text, $result->text);
    }


    /**
     * Keyboard options don't give anything special back, those are just commands to the user. Test this condition
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
        $result = $this->tgLog->performApiRequest($sendMessage);

        // Important assert: ensure we send a serialized object to Telegram
        $this->assertEquals(
            trim(file_get_contents('tests/Mock/MockData/SendMessage-replyKeyboardMarkup.txt')),
            $sendMessage->reply_markup
        );

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);
        $this->assertEquals(14, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(123456789, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendMessage->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452254253, $result->date);
        $this->assertNull($result->audio);

        $this->assertEquals($sendMessage->text, $result->text);
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
            $this->assertInstanceOf('\\stdClass', $e->decodedResponse);
            $this->assertEquals(400, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }

    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage chat_id
     */
    public function testSendIncompleteMessage()
    {
        $sendMessage = new SendMessage();
        $sendMessage->text = 'Hello world!';

        $this->tgLog->performApiRequest($sendMessage);
    }
}

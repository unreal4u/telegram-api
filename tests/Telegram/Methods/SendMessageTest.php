<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockTgLog;
use tests\Mock\MockClientException;
use unreal4u\Telegram\Methods\SendMessage;
use unreal4u\Telegram\Types\ReplyKeyboardMarkup;

class SendMessageTest extends \PHPUnit_Framework_TestCase
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
     * Asserts that the GetMe method ALWAYS load in a user type
     */
    public function testBindToObjectType()
    {
        $type = SendMessage::bindToObjectType();
        $this->assertEquals('Message', $type);
    }

    /**
     * @depends testBindToObjectType
     */
    public function testSendMessage()
    {
        $sendMessage = new SendMessage();
        $sendMessage->chat_id = 12341234;
        $sendMessage->text = 'Hello world';
        $result = $this->tgLog->performApiRequest($sendMessage);

        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\Message', $result);
        $this->assertEquals(14, $result->message_id);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\Chat', $result->chat);
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
            trim(file_get_contents('tests/Mock/MockData/sendMessage-replyKeyboardMarkup.txt')),
            $sendMessage->reply_markup
        );

        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\Message', $result);
        $this->assertEquals(14, $result->message_id);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\Chat', $result->chat);
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
            $this->setExpectedException('tests\\Mock\\MockClientException');
            throw $e;
        }
    }
}

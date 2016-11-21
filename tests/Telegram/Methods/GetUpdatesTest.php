<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UpdatesArray;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetUpdates;

class GetUpdatesTest extends TestCase
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
     * Tests a private message "Hello bot" to the bot
     */
    public function testGetUpdatesMessageIncoming()
    {
        $getUpdates = new GetUpdates();

        $result = $this->tgLog->performApiRequest($getUpdates);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Custom\\UpdatesArray', $result);
        $this->assertContainsOnlyInstancesOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Update', $result->data);
        $this->assertCount(1, $result->data);

        foreach ($result->traverseObject() as $theUpdate) {
            $this->assertEquals(12345678, $theUpdate->update_id);
            $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $theUpdate->message);

            $theMessage = $theUpdate->message;
            $this->assertEquals(12, $theMessage->message_id);
            $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $theMessage->from);
            $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $theMessage->chat);
            $this->assertEquals('Hello bot', $theMessage->text);
            $this->assertEquals(12345678, $theMessage->from->id);
            $this->assertEquals('unreal4u', $theMessage->from->username);
            $this->assertEquals(98765432, $theMessage->chat->id);
            $this->assertEquals('unreal4u', $theMessage->chat->username);

            $this->assertEquals(1452120442, $theMessage->date);
            $this->assertNull($theMessage->audio);
        }
    }

    public function testEmptyUpdates()
    {
        $this->tgLog->specificTest = 'emptyResponse';

        $getUpdates = new GetUpdates();
        $getUpdates->offset = 12345679;
        $result = $this->tgLog->performApiRequest($getUpdates);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Custom\\UpdatesArray', $result);
        $this->assertEquals(12345679, $getUpdates->offset);
        $this->assertCount(0, $result->data);
    }

    public function testWebHookAlreadyActive()
    {
        $this->tgLog->specificTest = 'webhookActive';
        $this->tgLog->mockException = true;

        try {
            $getUpdates = new GetUpdates();
            $this->tgLog->performApiRequest($getUpdates);
        } catch (MockClientException $e) {
            $this->assertInstanceOf('\\stdClass', $e->decodedResponse);
            $this->assertEquals(409, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }

    /**
     * Sometimes new API changes do break existing functionality. Assert this can't happen with new unknown types
     */
    public function testNewBotApiImplementation()
    {
        $this->tgLog->specificTest = 'newApiVersion';

        $getUpdates = new GetUpdates();
        /** @var UpdatesArray $updatesArray */
        $updatesArray = $this->tgLog->performApiRequest($getUpdates);
        foreach ($updatesArray->traverseObject() as $update) {
            $this->assertStringStartsWith('{"Unknown_Field":"This is an unknown field",', $update->array_unknown_field);
            $this->assertStringStartsWith('A special new string', $update->string_unknown_field);
            $this->assertFalse($update->boolean_unknown_field);
            $this->assertSame(42, $update->integer_unknown_field);
        }
    }
}

<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\GetUpdates;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UpdatesArray;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\PreCheckoutQuery;
use unreal4u\TelegramAPI\Telegram\Types\Update;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class GetUpdatesTest extends TestCase
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

    /**
     * Tests a private message "Hello bot" to the bot.
     */
    public function testGetUpdatesMessageIncoming()
    {
        $getUpdates = new GetUpdates();

        /** @var UpdatesArray $result */
        $promise = $this->tgLog->performApiRequest($getUpdates);

        $promise->then(function (UpdatesArray $result) {
            $this->assertInstanceOf(UpdatesArray::class, $result);
            $this->assertContainsOnlyInstancesOf(Update::class, $result->data);
            $this->assertCount(1, $result->data);

            foreach ($result->getIterator() as $theUpdate) {
                $this->assertEquals(12345678, $theUpdate->update_id);
                $this->assertInstanceOf(Message::class, $theUpdate->message);

                $theMessage = $theUpdate->message;
                $this->assertEquals(12, $theMessage->message_id);
                $this->assertInstanceOf(User::class, $theMessage->from);
                $this->assertInstanceOf(Chat::class, $theMessage->chat);
                $this->assertEquals('Hello bot', $theMessage->text);
                $this->assertEquals(12345678, $theMessage->from->id);
                $this->assertEquals('unreal4u', $theMessage->from->username);
                $this->assertEquals(98765432, $theMessage->chat->id);
                $this->assertEquals('unreal4u', $theMessage->chat->username);

                $this->assertEquals(1452120442, $theMessage->date);
                $this->assertNull($theMessage->audio);
            }
        });
    }

    public function testEmptyUpdates()
    {
        $this->tgLog->specificTest = 'emptyResponse';

        $getUpdates = new GetUpdates();
        $getUpdates->offset = 12345679;

        $promise = $this->tgLog->performApiRequest($getUpdates);

        $promise->then(function (UpdatesArray $result) use ($getUpdates) {
            $this->assertInstanceOf(UpdatesArray::class, $result);
            $this->assertEquals(12345679, $getUpdates->offset);
            $this->assertCount(0, $result->data);
        });
    }

    public function testWebHookAlreadyActive()
    {
        $this->tgLog->specificTest = 'webhookActive';
        $this->tgLog->mockException = true;

        try {
            $getUpdates = new GetUpdates();
            $this->tgLog->performApiRequest($getUpdates);
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(409, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }

    /**
     * Sometimes new API changes do break existing functionality. Assert this can't happen with new unknown types.
     */
    public function testNewBotApiImplementation()
    {
        $this->tgLog->specificTest = 'newApiVersion';

        $getUpdates = new GetUpdates();

        $promise = $this->tgLog->performApiRequest($getUpdates);

        $promise->then(function (UpdatesArray $updatesArray) {
            foreach ($updatesArray->getIterator() as $update) {
                $this->assertStringStartsWith(
                    '{"Unknown_Field":"This is an unknown field",',
                    json_encode($update->array_unknown_field)
                );
                $this->assertStringStartsWith('A special new string', $update->string_unknown_field);
                $this->assertFalse($update->boolean_unknown_field);
                $this->assertSame(42, $update->integer_unknown_field);
            }
        });
    }

    /**
     * new_chat_participant changed to new_chat_member. Validate this.
     */
    public function testNewChatMemberInUpdate()
    {
        $this->tgLog->specificTest = 'newChatMember';

        $getUpdates = new GetUpdates();

        $promise = $this->tgLog->performApiRequest($getUpdates);

        $promise->then(function (UpdatesArray $updatesArray) {
            foreach ($updatesArray->getIterator() as $update) {
                $this->assertInstanceOf(User::class, $update->message->new_chat_member);
            }
        });
    }

    public function testPreCheckoutQuery()
    {
        $this->tgLog->specificTest = 'preCheckoutQuery';

        $getUpdates = new GetUpdates();

        $promise = $this->tgLog->performApiRequest($getUpdates);

        /* @var Update $update */
        $promise->then(function (UpdatesArray $updatesArray) {
            foreach ($updatesArray->getIterator() as $update) {
                $this->assertInstanceOf(Update::class, $update);
                $this->assertInstanceOf(PreCheckoutQuery::class, $update->pre_checkout_query);
                $this->assertInstanceOf(User::class, $update->pre_checkout_query->from);
                $this->assertNull($update->pre_checkout_query->order_info);
                $this->assertSame(975, $update->pre_checkout_query->total_amount);
                $this->assertSame('EUR', $update->pre_checkout_query->currency);
            }
        });
    }
}

<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Types;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\CallbackQuery;
use unreal4u\TelegramAPI\Telegram\Types\Chat;
use unreal4u\TelegramAPI\Telegram\Types\Update;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class InlineKeyboardMarkupTest extends TestCase
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

    public function testIncomingUpdate()
    {
        $postData = $this->tgLog->getTestTypeResponse('InlineKeyboardMarkup');
        /** @var Update $update */
        $update = new Update($postData);

        $this->assertInstanceOf(CallbackQuery::class, $update->callback_query);
        $this->assertInstanceOf(User::class, $update->callback_query->message->from);
        $this->assertInstanceOf(Chat::class, $update->callback_query->message->chat);
        $this->assertCount(1, $update->callback_query->message->entities);
        $this->assertSame(56, $update->callback_query->message->reply_to_message->message_id);
        $this->assertSame('-1234567890123456789', $update->callback_query->chat_instance);
    }
}

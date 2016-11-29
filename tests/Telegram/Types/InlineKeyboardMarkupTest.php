<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Types;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\CallbackQuery;
use unreal4u\TelegramAPI\Telegram\Types\Update;
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

    public function testIncomingUpdate()
    {
        $postData = $this->tgLog->getTestTypeResponse('InlineKeyboardMarkup');
        $update = new Update($postData);

        $this->assertInstanceOf(CallbackQuery::class, $update->callback_query);
        #var_dump($update);
    }
}

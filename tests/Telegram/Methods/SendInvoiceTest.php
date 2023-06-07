<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\SendInvoice;
use unreal4u\TelegramAPI\Telegram\Types\Invoice;
use unreal4u\TelegramAPI\Telegram\Types\LabeledPrice;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class SendInvoiceTest extends TestCase
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

    public function testSendInvoice()
    {
        $sendInvoice = new SendInvoice();
        $sendInvoice->chat_id = 12341234;
        $sendInvoice->title = 'My Special Invoice';
        $sendInvoice->description = 'This is the description of the invoice';
        $sendInvoice->payload = 'specialItem-001';
        $sendInvoice->provider_token = 'TEST-TOKEN-TEST';
        $sendInvoice->start_parameter = 'u4u-invoice-0001';
        $sendInvoice->currency = 'EUR';
        $sendInvoice->prices = [new LabeledPrice(['amount' => 975, 'label' => 'That special item'])];

        $promise = $this->tgLog->performApiRequest($sendInvoice);

        $promise->then(function (Message $result) {
            $this->assertInstanceOf(Message::class, $result);
            $this->assertInstanceOf(Invoice::class, $result->invoice);
            $this->assertSame(975, $result->invoice->total_amount);
            $this->assertSame('EUR', $result->invoice->currency);
            $this->assertSame('u4u-invoice-0001', $result->invoice->start_parameter);
        });
    }
}

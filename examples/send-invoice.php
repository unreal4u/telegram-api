<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendInvoice;
use unreal4u\TelegramAPI\Telegram\Types\LabeledPrice;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\TgLog;

$sendInvoice = new SendInvoice();
$sendInvoice->chat_id = A_USER_CHAT_ID;
$sendInvoice->title = 'My Special Invoice';
$sendInvoice->description = 'This is the description of the invoice';
$sendInvoice->payload = 'specialItem-001';
$sendInvoice->provider_token = PAYMENT_TOKEN;
$sendInvoice->start_parameter = 'u4u-invoice-0001';
$sendInvoice->currency = 'EUR';
$sendInvoice->prices = [ new LabeledPrice(['amount' => 975, 'label' => 'That special item']) ];

var_dump($sendInvoice);

$tgLog = new TgLog(BOT_TOKEN);
/** @var Message $result */
$result = $tgLog->performApiRequest($sendInvoice);

var_dump($result);

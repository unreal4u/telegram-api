<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendInvoice;
use unreal4u\TelegramAPI\Telegram\Types\LabeledPrice;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendInvoice = new SendInvoice();
$sendInvoice->chat_id = A_USER_CHAT_ID;
$sendInvoice->title = 'My Special Invoice';
$sendInvoice->description = 'This is the description of the invoice';
$sendInvoice->payload = 'specialItem-001';
$sendInvoice->provider_token = PAYMENT_TOKEN;
$sendInvoice->start_parameter = 'u4u-invoice-0001';
$sendInvoice->currency = 'EUR';
$sendInvoice->prices = [ new LabeledPrice(['amount' => 975, 'label' => 'That special item']) ];

$promise = $tgLog->performApiRequest($sendInvoice);

$promise->then(
    function ($response) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();

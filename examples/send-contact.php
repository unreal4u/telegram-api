<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendContact;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendInvoice = new SendContact();
$sendInvoice->chat_id = A_USER_CHAT_ID;
$sendInvoice->phone_number = '+420123456789';
$sendInvoice->first_name = 'Tomas';
$sendInvoice->last_name = 'Palider';
$sendInvoice->vcard = 'BEGIN:VCARD
VERSION:3.0
EMAIL;TYPE=INTERNET:foo@example.com
END:VCARD';

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

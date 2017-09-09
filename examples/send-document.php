<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendDocument;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendDocument = new SendDocument();
$sendDocument->chat_id = A_USER_CHAT_ID;
$sendDocument->document = new InputFile(__FILE__);

$promise = $tgLog->performApiRequest($sendDocument);

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

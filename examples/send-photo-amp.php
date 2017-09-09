<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendPhoto;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;

\Amp\Loop::run(function () {
    $tgLog = new TgLog(BOT_TOKEN, new \unreal4u\TelegramAPI\HttpClientRequestHandlerAmp());

    $sendPhoto = new SendPhoto();
    $sendPhoto->chat_id = A_USER_CHAT_ID;
    $sendPhoto->photo = new InputFile(__DIR__ . '/binary-test-data/demo-photo.jpg');
    $sendPhoto->caption = 'Not sure if sending image or image not arriving';

    $promise = $tgLog->performApiRequest($sendPhoto);

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
});


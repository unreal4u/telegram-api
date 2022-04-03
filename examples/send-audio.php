<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendAudio;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$sendAudio = new SendAudio();
$sendAudio->chat_id = A_USER_CHAT_ID;
$sendAudio->audio = new InputFile('binary-test-data/ICQ-uh-oh.mp3');
$sendAudio->title = 'The famous ICQ new message alert';
$sendAudio->thumb = new InputFile(__DIR__ . '/binary-test-data/logo-php7-telegram-bot-api-thumbnail.jpg');

$promise = $tgLog->performApiRequest($sendAudio);

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

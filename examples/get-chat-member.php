<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\GetChatMember;
use unreal4u\TelegramAPI\TgLog;

$loop = \React\EventLoop\Factory::create();
$handler = new \unreal4u\TelegramAPI\HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$getCM = new GetChatMember();
$getCM->chat_id = A_GROUP_CHAT_ID;
$getCM->user_id = A_USER_CHAT_ID;

$promise = $tgLog->performApiRequest($getCM);

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

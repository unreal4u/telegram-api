<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetChatMember;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$getChatMember = new GetChatMember();
$getChatMember->chat_id = A_GROUP_CHAT_ID;
$getChatMember->user_id = A_USER_CHAT_ID;

$getChatMemberPromise = $tgLog->performApiRequest($getChatMember);
$getChatMemberPromise->then(
    function ($response) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage().PHP_EOL;
    }
);

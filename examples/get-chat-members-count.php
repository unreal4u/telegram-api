<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetChatMembersCount;
use unreal4u\TelegramAPI\TgLog;

$loop = \React\EventLoop\Factory::create();
$handler = new \unreal4u\TelegramAPI\HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$getCMC = new GetChatMembersCount();
$getCMC->chat_id = A_GROUP_CHAT_ID;

$promise = $tgLog->performApiRequest($getCMC);

$promise
    ->then(
        function ($response) {
            echo 'The number of participants in this chat are '.$response. ' members. Raw output as follows:'.PHP_EOL;
            echo '<pre>';
            var_dump($response);
            echo '</pre>';
        },
        function (ClientException $e) {
            var_dump('Captured ClientException', $e->getError());
        }
    )
;

$loop->run();

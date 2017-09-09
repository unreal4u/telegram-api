<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendChatAction;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'First message';
$tgLog->performApiRequest($sendMessage);

$sendChatAction = new SendChatAction();
$sendChatAction->chat_id = A_USER_CHAT_ID;
$sendChatAction->action = 'typing';

$promise = $tgLog->performApiRequest($sendChatAction);

$promise->then(function () use ($tgLog, $sendMessage) {
    sleep(3);

    $sendMessage->text = 'The second piece of text';

    $promise = $tgLog->performApiRequest($sendMessage);

    $promise->then(
        function ($response) {
            echo '2nd message sent' . PHP_EOL;
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

$loop->run();

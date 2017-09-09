<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

\Amp\Loop::run(function () {
    $tgLog = new TgLog(BOT_TOKEN, new \unreal4u\TelegramAPI\HttpClientRequestHandlerAmp());

    $sendMessage = new SendMessage();
    $sendMessage->chat_id = A_USER_CHAT_ID;
    $sendMessage->text = 'Hello world!';

    $tgLog->performApiRequest($sendMessage);
});
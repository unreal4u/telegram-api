<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;
use unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Abstracts\TelegramTypes;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$getMePromise = $tgLog->performApiRequest(new GetMe());
$getMePromise->then(
    function (TelegramTypes $getMeResponse) {
        var_dump($getMeResponse);
    },
    function (\Exception $e) {
        var_dump($e);
    }
);

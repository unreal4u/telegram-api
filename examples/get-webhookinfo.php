<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetWebhookInfo;
use unreal4u\TelegramAPI\Telegram\Types\WebhookInfo;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$webHookInfo = new GetWebhookInfo();
$promise = $tgLog->performApiRequest($webHookInfo);

$promise->then(
    function (WebhookInfo $info) {
        echo '<pre>';
        var_dump($info);
        echo '</pre>';
    },
    function (\Exception $e) {
        var_dump($e);
    }
);
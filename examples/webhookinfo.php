<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\GetWebhookInfo;
use unreal4u\TelegramAPI\Telegram\Types\WebhookInfo;
use unreal4u\TelegramAPI\TgLog;

$loop = \React\EventLoop\Factory::create();
$handler = new \unreal4u\TelegramAPI\HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$webHookInfo = new GetWebhookInfo();

$promise = $tgLog->performApiRequest($webHookInfo);

$promise->then(function (WebhookInfo $info) {
    echo '<pre>';
    var_dump($info);
    echo '</pre>';
});

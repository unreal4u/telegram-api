<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\GetWebhookInfo;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN);

$webHookInfo = new GetWebhookInfo();

$hookInfo = $tgLog->performApiRequest($webHookInfo);
echo '<pre>';
var_dump($hookInfo);
echo '</pre>';

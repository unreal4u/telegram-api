<?php

include('basics.php');

use unreal4u\TelegramAPI\Telegram\Methods\getWebhookInfo;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN);

$webHookInfo = new getWebhookInfo();

$hookInfo = $tgLog->performApiRequest($webHookInfo);
echo '<pre>';
var_dump($hookInfo);
echo '</pre>';

<?php

include('basics.php');

use unreal4u\TelegramLog;
use unreal4u\Telegram\Methods\SendLocation;

$tgLog = new TelegramLog(BOT_TOKEN);

$location = new SendLocation();
$location->chat_id = A_USER_CHAT_ID;
$location->latitude = 43.296482;
$location->longitude = 5.369779999999992;

$message = $tgLog->performApiRequest($location);
echo '<pre>';
var_dump($message);
echo '</pre>';

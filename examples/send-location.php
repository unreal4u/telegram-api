<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendLocation;

$tgLog = new TgLog(BOT_TOKEN);

$location = new SendLocation();
$location->chat_id = A_USER_CHAT_ID;
$location->latitude = 43.296482;
$location->longitude = 5.369763;

$message = $tgLog->performApiRequest($location);
echo '<pre>';
var_dump($message);
echo '</pre>';

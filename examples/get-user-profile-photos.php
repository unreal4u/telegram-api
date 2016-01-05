<?php

use unreal4u\Telegram\Methods\getUserProfilePhotos;
use unreal4u\TgLog;

include('basics.php');

$userProfilePhotos = new getUserProfilePhotos();
$tgLog = new TgLog(BOT_TOKEN);

$userProfilePhotos->user_id = A_USER_ID;
$userProfilePhotos = $tgLog->performApiRequest($userProfilePhotos);
echo '<pre>';
var_dump($userProfilePhotos);
echo '</pre>';

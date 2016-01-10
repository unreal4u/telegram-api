<?php

use unreal4u\Telegram\Methods\GetUserProfilePhotos;
use unreal4u\TgLog;

include('basics.php');

$userProfilePhotos = new GetUserProfilePhotos();
$tgLog = new TgLog(BOT_TOKEN);

$userProfilePhotos->user_id = A_USER_ID;
$userProfilePhotos = $tgLog->performApiRequest($userProfilePhotos);
echo '<pre>';
var_dump($userProfilePhotos);
echo '</pre>';

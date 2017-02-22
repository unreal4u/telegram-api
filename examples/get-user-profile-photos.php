<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos;
use unreal4u\TelegramAPI\TgLog;

$userProfilePhotos = new GetUserProfilePhotos();
$tgLog = new TgLog(BOT_TOKEN);

$userProfilePhotos->user_id = A_USER_ID;

try {
    $userProfilePhotos = $tgLog->performApiRequest($userProfilePhotos);
    echo '<pre>';
    var_dump($userProfilePhotos);
    echo '</pre>';
} catch (ClientException $e) {
    echo 'Error detected trying to get user profile photos, original response: <pre>';
    print_r((string)$e->getResponse()->getBody());
    echo '</pre>';
    die();
}

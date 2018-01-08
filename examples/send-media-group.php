<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendMediaGroup;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;
use unreal4u\TelegramAPI\TgLog;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TgLog(BOT_TOKEN);

$sendMediaGroup = new SendMediaGroup();
$sendMediaGroup->chat_id = A_USER_CHAT_ID;
#$photos = glob(__DIR__ . '/binary-test-data/*.jpg');

$photos = [
    'https://cdn.pixabay.com/photo/2018/01/04/19/43/desktop-background-3061483_960_720.jpg',
    'https://cdn.pixabay.com/photo/2017/02/20/19/59/sunset-2083771_960_720.jpg',
    'https://cdn.pixabay.com/photo/2017/09/07/15/37/space-2725697_960_720.jpg',
];

foreach ($photos as $photoLocation) {
    $inputMedia = new Photo();
    $inputMedia->media = $photoLocation;
    $inputMedia->caption = basename($photoLocation);
    $sendMediaGroup->media[] = $inputMedia;
}

try {
    $messageArray = $tgLog->performApiRequest($sendMediaGroup);
    $imagesSent = 0;
    echo '<pre>';
    foreach ($messageArray->traverseObject() as $message) {
        $imagesSent++;
    }
    var_dump('Sent ' . $imagesSent . ' images');
    echo '</pre>';
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    var_dump($e->getRequest());
    #var_dump($e->getTrace());
    echo '</pre>';
}

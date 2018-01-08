<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendMediaGroup;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

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

$promise = $tgLog->performApiRequest($sendMediaGroup);

$promise->then(
    function ($response) {
        echo '<pre>';
        $imageCounter = 0;
        foreach ($response->traverseObject() as $message) {
            $imageCounter++;
        }
        var_dump('Sent ' . $imageCounter . ' images');
        echo '</pre>';
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();

<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SendMediaGroup;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Video;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendMediaGroup = new SendMediaGroup();
$sendMediaGroup->chat_id = A_USER_CHAT_ID;
$photos = glob(__DIR__ . '/binary-test-data/*.jpg');

// Also send a few pictures directly from the internet
$photos[] = 'https://cdn.pixabay.com/photo/2018/01/04/19/43/desktop-background-3061483_960_720.jpg';
$photos[] = 'https://cdn.pixabay.com/photo/2017/02/20/19/59/sunset-2083771_960_720.jpg';
$photos[] = 'https://cdn.pixabay.com/photo/2017/09/07/15/37/space-2725697_960_720.jpg';

$i = 1;
foreach ($photos as $photoLocation) {
    $inputMediaPhoto = new Photo();
    $inputMediaPhoto->media = $photoLocation;
    $inputMediaPhoto->caption = 'photo: ' . basename($photoLocation) . ' - ' . $i;
    $sendMediaGroup->media[] = $inputMediaPhoto;
    $i++;
}

$inputMediaVideo = new Video();
$inputMediaVideo->media = __DIR__ . '/binary-test-data/demo-video.mp4';
$inputMediaVideo->caption = 'A nice video about... nothing really';
$sendMediaGroup->media[] = $inputMediaVideo;

$promise = $tgLog->performApiRequest($sendMediaGroup);

$promise->then(
    static function ($response) {
        echo '<pre>';
        $imageCounter = 0;
        foreach ($response->traverseObject() as $message) {
            $imageCounter++;
        }
        var_dump('Sent ' . $imageCounter . ' images');
        echo '</pre>';
    },
    static function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage() . PHP_EOL;
    }
);

$loop->run();

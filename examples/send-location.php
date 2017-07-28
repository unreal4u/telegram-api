<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendLocation;
use unreal4u\TelegramAPI\TgLog;

$loop = \React\EventLoop\Factory::create();
$handler = new \unreal4u\TelegramAPI\HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$location = new SendLocation();
$location->chat_id = A_USER_CHAT_ID;
$location->latitude = 43.296482;
$location->longitude = 5.369763;

$promise = $tgLog->performApiRequest($location);

$promise->then(
    function ($response) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();

<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetUpdates;
use \unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$getUpdates = new GetUpdates();

// If using this method, send an offset (AKA last known update_id) to avoid getting duplicate update notifications.
#$getUpdates->offset = 328221148;
$updatePromise = $tgLog->performApiRequest($getUpdates);
$updatePromise->then(
    function (TraversableCustomType $updatesArray) {
        foreach ($updatesArray as $update) {
            var_dump($update->update_id);
        }
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

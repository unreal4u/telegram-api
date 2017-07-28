<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\InternalFunctionality\TelegramDocument;
use unreal4u\TelegramAPI\Telegram\Methods\GetFile;
use unreal4u\TelegramAPI\Telegram\Types\File;
use unreal4u\TelegramAPI\TgLog;

$loop = \React\EventLoop\Factory::create();
$handler = new \unreal4u\TelegramAPI\HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$getFile = new GetFile();
// You can get a file id from an update, webhook or any other message object
$getFile->file_id = A_FILE_ID;

$filePromise = $tgLog->performApiRequest($getFile);

$filePromise->then(
    function (File $file) use ($tgLog) {
        $documentPromise = $tgLog->downloadFile($file);
        
        $documentPromise->then(function (TelegramDocument $document) {
            echo '<pre>';
            var_dump($document);
            echo '</pre>';
        });
    }
);

$loop->run();

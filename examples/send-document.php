<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetFile;
use unreal4u\TelegramAPI\Telegram\Methods\SendDocument;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;
use function Clue\React\Block\await;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$sendDocument = new SendDocument();
$sendDocument->chat_id = A_USER_CHAT_ID;
$sendDocument->document = new InputFile(__FILE__);
$sendDocument->thumbnail = new InputFile(__DIR__ . '/binary-test-data/logo-php7-telegram-bot-api-thumbnail.jpg');

$promise = $tgLog->performApiRequest($sendDocument);

$promise->then(
    function ($response) use ($tgLog, $loop) {
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
        /** @var $response \unreal4u\TelegramAPI\Telegram\Types\Message */

        // Load uploaded video and generate URL to download using bot token
        $getFileVideo = new GetFile();
        $getFileVideo->file_id = $response->document->file_id;
        $fileVideo = await($tgLog->performApiRequest($getFileVideo), $loop);
        var_dump('Document url: ' . $tgLog->fileUrl($fileVideo));

        // Load uploaded thumbnail and generate URL to download using bot token
        $getFileThumb = new GetFile();
        $getFileThumb->file_id = $response->document->thumbnail->file_id;
        $fileThumb = await($tgLog->performApiRequest($getFileThumb), $loop);
        var_dump('Thumbnail url: ' . $tgLog->fileUrl($fileThumb));
    },
    function (\Exception $exception) {
        // Onoes, an exception occurred...
        echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
    }
);

$loop->run();

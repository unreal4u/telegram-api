<?php

include('basics.php');

use unreal4u\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramLog;
use unreal4u\Telegram\Methods\SendVideo;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TelegramLog(BOT_TOKEN);

$sendVideo = new SendVideo();
$sendVideo->chat_id = A_USER_CHAT_ID;
$sendVideo->video = new InputFile('examples/binary-test-data/demo-video.mp4');
$sendVideo->caption = 'Example of a video file sent with Telegram';

try {
    $message = $tgLog->performApiRequest($sendVideo);
    echo '<pre>';
    var_dump($message);
    echo '</pre>';
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    var_dump($e->getRequest());
    var_dump($e->getTrace());
    echo '</pre>';
}

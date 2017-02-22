<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendChatAction;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendVideo;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TgLog(BOT_TOKEN);

// Let the user know we are doing some intensive stuff
$sendChatAction = new SendChatAction();
$sendChatAction->chat_id = A_USER_CHAT_ID;
$sendChatAction->action = 'upload_video';
$tgLog->performApiRequest($sendChatAction);

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

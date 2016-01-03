<?php

include('basics.php');

use unreal4u\TelegramLog;
use unreal4u\Telegram\Methods\SendAudio;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TelegramLog(BOT_TOKEN);

$sendAudio = new SendAudio();
$sendAudio->chat_id = A_USER_CHAT_ID;
// Send out cURL-style file
$sendAudio->audio = '@examples/binary-test-data/ICQ-uh-oh.mp3';
$sendAudio->title = 'The famous ICQ new message alert';

try {
    $message = $tgLog->performApiRequest($sendAudio);
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

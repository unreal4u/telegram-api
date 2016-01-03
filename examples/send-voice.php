<?php

include('basics.php');

use unreal4u\TelegramLog;
use unreal4u\Telegram\Methods\SendVoice;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TelegramLog(BOT_TOKEN);

$sendVoice = new SendVoice();
$sendVoice->chat_id = A_USER_CHAT_ID;
// Send out cURL-style file
$sendVoice->voice = '@examples/binary-test-data/demo-voice.ogg';

try {
    $message = $tgLog->performApiRequest($sendVoice);
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

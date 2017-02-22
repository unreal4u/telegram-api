<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendVoice;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TgLog(BOT_TOKEN);

$sendVoice = new SendVoice();
$sendVoice->chat_id = A_USER_CHAT_ID;
$sendVoice->voice = new InputFile('examples/binary-test-data/demo-voice.ogg');

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

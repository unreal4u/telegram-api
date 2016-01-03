<?php

include('basics.php');

use unreal4u\Telegram\Methods\SendDocument;
use unreal4u\TelegramLog;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TelegramLog(BOT_TOKEN);

$sendDocument = new SendDocument();
$sendDocument->chat_id = A_USER_CHAT_ID;
// Send out cURL-style file
$sendDocument->document = '@'.__FILE__;

try {
    $message = $tgLog->performApiRequest($sendDocument);
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

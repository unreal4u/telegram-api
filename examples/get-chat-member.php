<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetChatMember;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN);

$getCM = new GetChatMember();
$getCM->chat_id = A_GROUP_CHAT_ID;
$getCM->user_id = A_USER_CHAT_ID;

try {
    $response = $tgLog->performApiRequest($getCM);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    echo 'Exception catched, error is: <pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetChatMembersCount;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN);

$getCMC = new GetChatMembersCount();
$getCMC->chat_id = A_GROUP_CHAT_ID;

try {
    $response = $tgLog->performApiRequest($getCMC);
    echo 'The number of participants in this chat are '.$response. ' members. Raw output as follows:'.PHP_EOL;
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    echo 'Exception catched, error is: <pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

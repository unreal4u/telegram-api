<?php

include('basics.php');

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramLog;
use unreal4u\Telegram\Methods\GetMe;

$tgLog = new TelegramLog(BOT_TOKEN);

$getMe = new GetMe();

try {
    $response = $tgLog->performApiRequest($getMe);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    echo '<pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

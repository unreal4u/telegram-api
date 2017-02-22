<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;

$tgLog = new TgLog(BOT_TOKEN);

$getMe = new GetMe();

try {
    $response = $tgLog->performApiRequest($getMe);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    echo 'Exception catched, error is: <pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

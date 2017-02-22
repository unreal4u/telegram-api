<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendPhoto;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TgLog(BOT_TOKEN);

$sendPhoto = new SendPhoto();
$sendPhoto->chat_id = A_USER_CHAT_ID;
$sendPhoto->photo = new InputFile('examples/binary-test-data/demo-photo.jpg');
$sendPhoto->caption = 'Not sure if sending image or image not arriving';

try {
    $message = $tgLog->performApiRequest($sendPhoto);
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

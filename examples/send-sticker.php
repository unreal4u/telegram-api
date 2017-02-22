<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Telegram\Methods\SendSticker;
use unreal4u\TelegramAPI\TgLog;
use GuzzleHttp\Exception\ClientException;

$tgLog = new TgLog(BOT_TOKEN);

$sendSticker = new SendSticker();
$sendSticker->chat_id = A_USER_CHAT_ID;
// Send out an existing sticker
$sendSticker->sticker = 'BQADBAADsgUAApv7sgABW0IQT2B3WekC';

try {
    $message = $tgLog->performApiRequest($sendSticker);
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

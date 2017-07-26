<?php

declare(strict_types = 1);

include 'basics.php';

use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendLocation;

$tgLog = new TgLog(BOT_TOKEN);

$location = new SendLocation();
$location->chat_id = A_USER_CHAT_ID.'11';
$location->latitude = 43.296482;
$location->longitude = 5.369763;

echo '<pre>';
try {
    /** @var \unreal4u\TelegramAPI\Telegram\Types\Message $message */
    $message = $tgLog->performApiRequest($location);
    echo 'Location sent successfully, messageId: '.$message->message_id;
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    printf('Exception catched, errorcode: %d, errorMessage: "%s"%s', $e->getCode(), $e->getMessage(), PHP_EOL.PHP_EOL);
    printf('Additional class with information: %s%s', PHP_EOL, print_r($e->getError(), true));
}
echo '</pre>';

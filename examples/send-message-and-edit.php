<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessageText;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\TgLog;

$logger = new Logger('CUSTOM-EXAMPLE');
$logger->pushHandler(new StreamHandler('logs/custom-example.log'));

$tgLog = new TgLog(BOT_TOKEN, $logger);
$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world, this is a test';
$message = $tgLog->performApiRequest($sendMessage);

sleep(3);
$editMessageText = new EditMessageText();
$editMessageText->message_id = $message->message_id;
#$editMessageText->message_id = 1112222;
$editMessageText->chat_id = $message->chat->id;
$editMessageText->text = 'Sorry, this is the correction of an hello world';
try {
    $message = $tgLog->performApiRequest($editMessageText);
} catch (ClientException $e) {
    var_dump($e->getRequest());
}

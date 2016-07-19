<?php

include('basics.php');

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Types\ReplyKeyboardMarkup;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$tgLog = new TgLog(BOT_TOKEN);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world to the user... from a specialized getMessage file. Have you read this message?';
$sendMessage->reply_markup = new ReplyKeyboardMarkup();
$sendMessage->reply_markup->keyboard = [['Yes', 'No']];

try {
    $tgLog->performApiRequest($sendMessage);
    printf('Message "%s" sent!<br/>%s', $sendMessage->text, PHP_EOL);
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getRequest());
    echo '</pre>';
    die();
}

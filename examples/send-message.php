<?php

include('basics.php');

use GuzzleHttp\Exception\ClientException;
use \unreal4u\TelegramLog;
use \unreal4u\Telegram\Methods\SendMessage;

$tgLog = new TelegramLog(BOT_TOKEN);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world to the user... from a specialized getMessage file';
try {
    $tgLog->performApiRequest($sendMessage);
    printf('Message "%s" sent!<br/>%s', $sendMessage->text, PHP_EOL);
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getRequest());
    echo '</pre>';
    die();
}

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_GROUP_CHAT_ID;
$sendMessage->text = 'And this is an hello the the group... also from a getMessage file';
try {
    $tgLog->performApiRequest($sendMessage);
    printf('Message "%s" sent!<br/>%s', $sendMessage->text, PHP_EOL);
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getRequest());
    echo '</pre>';
    die();
}

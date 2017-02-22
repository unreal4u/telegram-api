<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Methods\SendChatAction;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$tgLog = new TgLog(BOT_TOKEN);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'First message';
$tgLog->performApiRequest($sendMessage);

$sendChatAction = new SendChatAction();
$sendChatAction->chat_id = A_USER_CHAT_ID;
$sendChatAction->action = 'typing';

$tgLog->performApiRequest($sendChatAction);
// Some heavy operation you have to perform, in our case, it will 2 seconds
sleep(2);

$sendMessage->text = 'The second piece of text';

try {
    $tgLog->performApiRequest($sendMessage);
    printf('Message "%s" sent!<br/>%s', $sendMessage->text, PHP_EOL);
} catch (ClientException $e) {
    echo 'Error detected trying to send message to user: <pre>';
    var_dump($e->getRequest());
    echo '</pre>';
    die(1);
}

<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use \React\EventLoop\Factory;
use React\EventLoop\Loop;
use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog->performApiRequest($sendMessage);

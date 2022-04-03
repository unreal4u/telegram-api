<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use React\EventLoop\Loop;
use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;
use unreal4u\TelegramAPI\TgLog;

$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler(Loop::get()));

$response = Clue\React\Block\await($tgLog->performApiRequest(new GetMe()), Loop::get());
var_dump($response);

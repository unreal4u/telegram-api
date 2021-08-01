<?php

declare(strict_types=1);

include __DIR__ . '/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use unreal4u\TelegramAPI\Telegram\Methods\SetMyCommands;
use unreal4u\TelegramAPI\Telegram\Types\BotCommand;
use unreal4u\TelegramAPI\Telegram\Types\BotCommandScope;
use unreal4u\TelegramAPI\TgLog;

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop));

$method = new SetMyCommands();

$command = new BotCommand();
$command->command = 'help';
$command->description = 'description for command help for default scope';
$method->commands[] = $command;

$command = new BotCommand();
$command->command = 'settings';
$command->description = sprintf('%s icon and settings description for default scope', "\u{2764}");
$method->commands[] = $command;

$promise = $tgLog->performApiRequest($method);
$promise->then(
    function (TelegramTypes $response) {
        var_dump('Commands for default scope were set. Use GetMyCommands() to get list of them.');
    },
    function (\Exception $e) {
        var_dump($e->getTraceAsString());
    }
);

$loop->run();

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

$scopeType = 'all_private_chats';

$method = new SetMyCommands();
$method->scope = new BotCommandScope();
$method->scope->type = $scopeType;

$command = new BotCommand();
$command->command = 'help';
$command->description = sprintf('description for command help in scope %s', $scopeType);
$method->commands[] = $command;

$command = new BotCommand();
$command->command = 'settings';
$command->description = sprintf('%s icon and settings description in scope %s', "\u{2764}", $scopeType);
$method->commands[] = $command;

$command = new BotCommand();
$command->command = 'foo_bar';
$command->description = sprintf('just another command visible only in scope %s', $scopeType);
$method->commands[] = $command;

$promise = $tgLog->performApiRequest($method);
$promise->then(
    function (TelegramTypes $response) use ($scopeType) {
        var_dump(sprintf('Commands for scope "%s" were set. Use GetMyCommands() to get list of them.', $scopeType));
    },
    function (\Exception $e) {
        var_dump($e->getTraceAsString());
    }
);

$loop->run();

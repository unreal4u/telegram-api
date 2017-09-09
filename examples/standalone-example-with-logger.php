<?php

/*
 * NOTE: in order for this script to work, you must install this module with --dev enabled, otherwise Monolog won't be
 * installed because we depend on PSR-3, not Monolog specific, unless you already use it.
 *
 * You can run this example (or any other in this same folder) as follows:
 * vagrant ssh
 * cd /var/www/default/
 * composer update -o
 * php examples/standalone-example-with-logger.php
 */
declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos;
use unreal4u\TelegramAPI\Telegram\Types\UserProfilePhotos;
use unreal4u\TelegramAPI\TgLog;

$logger = new Logger('CUSTOM-EXAMPLE');
$logger->pushHandler(new StreamHandler('logs/custom-example.log'));

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop), $logger);

$userProfilePhotos = new GetUserProfilePhotos();
$userProfilePhotos->user_id = A_USER_ID;

$promise = $tgLog->performApiRequest($userProfilePhotos);

$promise->then(function (UserProfilePhotos $photos) {
    var_dump($photos);
});

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

include 'basics.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos;
use unreal4u\TelegramAPI\TgLog;

$logger = new Logger('CUSTOM-EXAMPLE');
$logger->pushHandler(new StreamHandler('logs/custom-example.log'));

$tgLog = new TgLog(BOT_TOKEN, $logger);
$userProfilePhotos = new GetUserProfilePhotos();
$userProfilePhotos->user_id = A_USER_ID;

$photos = $tgLog->performApiRequest($userProfilePhotos);
var_dump($photos);

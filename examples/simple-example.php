<?php

chdir(dirname(__FILE__) . '/../');
include('vendor/autoload.php');
include('examples/conf.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

use \unreal4u\TelegramLog;
use \unreal4u\LinkedData\Contact;
use \unreal4u\LinkedData\Group;

$tgLog = new TelegramLog(BOT_TOKEN);
$userInformation = $tgLog->getInformation();
printf(
    'This bot is called <strong>%s</strong> and has id <strong>%d</strong>%s',
    $userInformation->result->first_name,
    $userInformation->result->id,
    PHP_EOL
);

#$updates = $tgLog->getUpdates();
#echo '<pre>' . print_r($updates, true) . '</pre>';

$tgLog->sendToUser('Hello world to the user', new Contact(UNREAL4U_USER));
$tgLog->broadcast('Hello world to the group!', new Group(UNREAL4U_GROUP));

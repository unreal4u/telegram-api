<?php

chdir(dirname(__FILE__).'/../');
include('vendor/autoload.php');

use \unreal4u\Contact;
use \unreal4u\TelegramLog;

$contact = new Contact([
    'name' => 'Camilo Sperberg',
    'id' => 'unreal4u',
    'telegramId' => 'xxxx',
]);

$tgLog = new TelegramLog();
$tgLog->assignContact($contact);

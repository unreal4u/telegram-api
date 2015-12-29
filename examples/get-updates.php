<?php

chdir(dirname(__FILE__) . '/../');
include('vendor/autoload.php');
include('examples/conf.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

use \unreal4u\TelegramLog;
use \unreal4u\Telegram\Methods\GetUpdates;

$tgLog = new TelegramLog(BOT_TOKEN);

$getUpdates = new GetUpdates();
$updates = $tgLog->performApiRequest($getUpdates);

echo '<pre>';
foreach ($updates->traverseUpdates() as $update) {
    var_dump($update);
    #var_dump(sprintf('Chat id is #%d', $update->message->chat->id));
}
echo '</pre>';

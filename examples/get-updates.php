<?php

include('basics.php');

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

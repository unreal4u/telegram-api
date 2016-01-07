<?php

include('basics.php');

use \unreal4u\TgLog;
use \unreal4u\Telegram\Methods\GetUpdates;

$tgLog = new TgLog(BOT_TOKEN);

$getUpdates = new GetUpdates();
#$getUpdates->offset = 328221148;
$updates = $tgLog->performApiRequest($getUpdates);

echo '<pre>';
foreach ($updates->traverseUpdates() as $update) {
    var_dump($update);
    #var_dump(sprintf('Chat id is #%d', $update->message->chat->id));
}
echo '</pre>';

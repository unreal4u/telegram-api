<?php

declare(strict_types = 1);

include 'basics.php';

use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\GetUpdates;

$tgLog = new TgLog(BOT_TOKEN);

$getUpdates = new GetUpdates();
#$getUpdates->offset = 328221148;

echo '<pre>';
try {
    $updates = $tgLog->performApiRequest($getUpdates);
    /* @var \unreal4u\TelegramAPI\Telegram\Types\Custom\UpdatesArray $updates */
    foreach ($updates->traverseObject() as $update) {
        var_dump($update);
        #var_dump(sprintf('Chat id is #%d', $update->message->chat->id));
    }
} catch (\Exception $e) {
    $actualProblem = json_decode((string)$e->getResponse()->getBody());
    print_r('[EXCEPTION] '.$actualProblem->description.'; original response:');
    print_r($actualProblem);
}

echo '</pre>';

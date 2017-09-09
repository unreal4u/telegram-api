<?php

declare(strict_types = 1);

include __DIR__.'/basics.php';

use React\EventLoop\Factory;
use unreal4u\TelegramAPI\HttpClientRequestHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use unreal4u\TelegramAPI\Telegram\Methods\EditMessageText;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\TgLog;

$logger = new Logger('CUSTOM-EXAMPLE');
$logger->pushHandler(new StreamHandler('logs/custom-example.log'));

$loop = Factory::create();
$tgLog = new TgLog(BOT_TOKEN, new HttpClientRequestHandler($loop), $logger);
$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world, this is a test';
$firstMessagePromise = $tgLog->performApiRequest($sendMessage);
$loop->run();

sleep(3);
$firstMessagePromise->then(
    function (Message $message) use ($tgLog) {
        $editMessageText = new EditMessageText();
        $editMessageText->message_id = $message->message_id;
        $editMessageText->chat_id = $message->chat->id;
        $editMessageText->text = 'Sorry, this is the correction of an hello world';

        $messageCorrectionPromise = $tgLog->performApiRequest($editMessageText);

        $messageCorrectionPromise->then(
            function ($response) {
                echo '<pre>';
                var_dump($response);
                echo '</pre>';
            },
            function (\Exception $exception) {
                // Onoes, an exception occurred...
                echo 'Exception ' . get_class($exception) . ' caught, message: ' . $exception->getMessage();
            }
        );
    }
);

$loop->run();

<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Button;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$tgLog = new TgLog(BOT_TOKEN);
$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hi, this an inline keyboard example';
// 1 2 3
// 4 5 6
// 7 8 9
//   0
$row = null;

// Choose one of the following 2 methods:

// METHOD 1: all in once with an array construction
$inlineKeyboard = new Markup([
    'inline_keyboard' => [
        [
            ['text' => '1', 'callback_data' => 'k=1'],
            ['text' => '2', 'callback_data' => 'k=2'],
            ['text' => '3', 'callback_data' => 'k=3'],
        ],
        [
            ['text' => '4', 'callback_data' => 'k=4'],
            ['text' => '5', 'callback_data' => 'k=5'],
            ['text' => '6', 'callback_data' => 'k=6'],
        ],
        [
            ['text' => '7', 'callback_data' => 'k=7'],
            ['text' => '8', 'callback_data' => 'k=8'],
            ['text' => '9', 'callback_data' => 'k=9'],
        ],
        [
            ['text' => '0', 'callback_data' => 'k=0'],
        ],
    ]
]);


// METHOD 2: in parts, working directly with the object
/*
$inlineKeyboard = new Markup();
for ($i = 1; $i < 10; $i++) {
    $inlineKeyboardButton = new Button();
    $inlineKeyboardButton->text = (string)$i;
    $inlineKeyboardButton->callback_data = 'k='.(string)$i;

    $row[] = $inlineKeyboardButton;
    if (count($row) > 2) {
        $inlineKeyboard->inline_keyboard[] = $row;
        $row = null;
    }
}

$inlineKeyboardButton = new Button();
$inlineKeyboardButton->text = '0';
$inlineKeyboardButton->callback_data = 'k=0';
$inlineKeyboard->inline_keyboard[][] = $inlineKeyboardButton;
*/
$sendMessage->disable_web_page_preview = true;
$sendMessage->parse_mode = 'Markdown';
$sendMessage->reply_markup = $inlineKeyboard;

try {
    $tgLog->performApiRequest($sendMessage);
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}

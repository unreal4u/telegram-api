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

<?php

include('basics.php');
use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\Telegram\Types\ReplyKeyboardMarkup;
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
for ($i=1;$i<10;$i++){
	$inlineKeyboardButton = new Button();
	$inlineKeyboardButton->text = (string)$i;
	$inlineKeyboardButton->callback_data = serialize(['k'=>$i, 'id'=>12345]);
	
	$row[] = $inlineKeyboardButton;
	if (count($row) > 2){
		$inlineKeyboardMarkup->inline_keyboard[] = $row; 
		$row = null;
	}
}
$inlineKeyboardButton = new Button();
$inlineKeyboardButton->text = "0";
$inlineKeyboardButton->callback_data = serialize(['k'=>0, 'id'=>12345]);;
$inlineKeyboardMarkup->inline_keyboard[] = [$inlineKeyboardButton];

$sendMessage->disable_web_page_preview = true;
$sendMessage->parse_mode = 'Markdown';
$sendMessage->reply_markup = $inlineKeyboardMarkup;

try {
    $tgLog->performApiRequest($sendMessage);
} catch (ClientException $e) {
    echo '<pre>';
    var_dump($e->getRequest());
    echo '</pre>';
    die();
}

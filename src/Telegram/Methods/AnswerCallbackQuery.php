<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the
 * user as a notification at the top of the chat screen or as an alert. On success, True is returned.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#answercallbackquery
 */
class AnswerCallbackQuery extends TelegramMethods
{
    /**
     * Unique identifier for the query to be answered
     * @var string
     */
    public $callback_query_id = '';

    /**
     * Optional. Text of the notification. If not specified, nothing will be shown to the user
     * @var string
     */
    public $text = '';

    /**
     * Optional. If true, an alert will be shown by the client instead of a notification at the top of the chat screen.
     * Defaults to false.
     * @var boolean
     */
    public $show_alert = false;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }
}

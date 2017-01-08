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
 * Alternatively, the user can be redirected to the specified Game URL. For this option to work, you must first create a
 * game for your bot via BotFather and accept the terms. Otherwise, you may use links like
 * telegram.me/your_bot?start=XXXX that open your bot with a parameter
 *
 * Objects defined as-is January 2017
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

    /**
     * URL that will be opened by the user's client. If you have created a Game and accepted the conditions via
     * @Botfather, specify the URL that opens your game – note that this will only work if the query comes from a
     * callback_game button.
     *
     * Otherwise, you may use links like telegram.me/your_bot?start=XXXX that open your bot with a parameter.
     *
     * @var string
     */
    public $url = '';

    /**
     * Optional. The maximum amount of time in seconds that the result of the callback query may be cached client-side.
     * Telegram apps will support caching starting in version 3.14. Defaults to 0.
     * @var int
     */
    public $cache_time = 0;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'callback_query_id',
        ];
    }
}

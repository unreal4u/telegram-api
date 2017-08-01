<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Use this method to send answers to an inline query. On success, True is returned.
 * No more than 50 results per query are allowed.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#answerinlinequery
 */
class AnswerInlineQuery extends TelegramMethods
{
    /**
     * Unique identifier for the answered query
     * @var string
     */
    public $inline_query_id = '';

    /**
     * A JSON-serialized array (of InlineQueryResult) of results for the inline query
     * @var array[]
     */
    protected $results = [];

    /**
     * Optional. The maximum amount of time in seconds that the result of the inline query may be cached on the server.
     * Defaults to 300.
     * @var int
     */
    public $cache_time = 300;

    /**
     * Optional. Pass True, if results may be cached on the server side only for the user that sent the query. By
     * default, results may be returned to any user who sends the same query
     * @var bool
     */
    public $is_personal = false;

    /**
     * Optional. Pass the offset that a client should send in the next query with the same text to receive more results.
     * Pass an empty string if there are no more results or if you don‘t support pagination. Offset length can’t
     * exceed 64 bytes.
     * @var string
     */
    public $next_offset = '';

    /**
     * Optional. If passed, clients will display a button with specified text that switches the user to a private chat
     * with the bot and sends the bot a start message with the parameter switch_pm_parameter
     * @var string
     */
    public $switch_pm_text = '';

    /**
     * Optional. Parameter for the start message sent to the bot when user presses the switch button
     *
     * Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to
     * adapt search results accordingly. To do this, it displays a ‘Connect your YouTube account’ button above the
     * results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in
     * doing so, passes a start parameter that instructs the bot to return an oauth link. Once done, the bot can offer a
     * switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline
     * capabilities.
     *
     * @var string
     */
    public $switch_pm_parameter = '';

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function performSpecialConditions(): TelegramMethods
    {
        $this->results = json_encode($this->results);

        return parent::performSpecialConditions();
    }

    public function getMandatoryFields(): array
    {
        return [
            'inline_query_id',
            'results',
        ];
    }

    /**
     * Use this method to add a result, this will delete all additional unneeded information from the subclass
     *
     * @param Result $result
     * @return AnswerInlineQuery
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function addResult(Result $result): AnswerInlineQuery
    {
        $this->results[] = $result->export();
        return $this;
    }

    public function getResults(): string
    {
        return $this->results;
    }
}

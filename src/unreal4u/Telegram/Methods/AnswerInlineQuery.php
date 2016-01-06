<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * Use this method to send answers to an inline query. On success, True is returned.
 * No more than 50 results per query are allowed.
 *
 * @see https://core.telegram.org/bots/api#answerinlinequery
 */
class AnswerInlineQuery extends AbstractMethodFunctions
{
    /**
     * Unique identifier for the answered query
     * @var string
     */
    public $inline_query_id = '';

    /**
     * A JSON-serialized array (of InlineQueryResult) of results for the inline query
     * @var array
     */
    public $results = [];

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
     * Pass an empty string if there are no more results or if you don‘t support pagination. Offset length can’t exceed
     * 64 bytes.
     * @var string
     */
    public $next_offset = '';

    public static function bindToObjectType(): string
    {
        return 'Custom\\ResultBoolean';
    }
}

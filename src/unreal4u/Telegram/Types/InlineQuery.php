<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some
 * default or trending results.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequery
 */
class InlineQuery extends AbstractFiller
{
    /**
     * Unique identifier for this query
     * @var string
     */
    public $id = '';

    /**
     * User‘s or bot’s first name
     * @var string
     */
    public $from = null;

    /**
     * Text of the query
     * @var string
     */
    public $query = '';

    /**
     * Offset of the results to be returned, can be controlled by the bot
     * @var string
     */
    public $offset = '';

    public function __construct(\stdClass $data)
    {
        if (!empty($data->from)) {
            $data->from = new User($data->from);
        }
        parent::__construct($data);
    }
}

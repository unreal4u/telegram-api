<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\Abstracts\TelegramTypes;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following 5
 * types:
 *
 * InlineQueryResultArticle
 * InlineQueryResultPhoto
 * InlineQueryResultGif
 * InlineQueryResultMpeg4Gif
 * InlineQueryResultVideo
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresult
 */
abstract class InlineQueryResult extends TelegramTypes
{
    /**
     * Represents a link to an article or web page
     * @var string
     */
    public $type = '';

    /**
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    public $id = '';
}

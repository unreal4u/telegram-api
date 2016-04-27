<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following
 * types:
 *
 * InlineQueryResultCachedAudio
 * InlineQueryResultCachedDocument
 * InlineQueryResultCachedGif
 * InlineQueryResultCachedMpeg4Gif
 * InlineQueryResultCachedPhoto
 * InlineQueryResultCachedSticker
 * InlineQueryResultCachedVideo
 * InlineQueryResultCachedVoice
 * InlineQueryResultArticle
 * InlineQueryResultAudio
 * InlineQueryResultContact
 * InlineQueryResultDocument
 * InlineQueryResultGif
 * InlineQueryResultLocation
 * InlineQueryResultMpeg4Gif
 * InlineQueryResultPhoto
 * InlineQueryResultVenue
 * InlineQueryResultVideo
 * InlineQueryResultVoice
 *
 * Objects defined as-is april 2016
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

    /**
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup
     */
    public $reply_markup = null;

    protected function mapSubObjects(): array
    {
        return [
            'reply_markup' => 'InlineKeyboardMarkup',
        ];
    }
}

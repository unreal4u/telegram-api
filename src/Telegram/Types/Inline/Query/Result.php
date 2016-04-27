<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query;

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
abstract class Result extends TelegramTypes
{
    /**
     * The type of InlineQueryResult we sent. Is automatically pre-filled by the child
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

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content = null;

    protected function mapSubObjects(): array
    {
        return [
            'reply_markup' => 'InlineKeyboardMarkup',
        ];
    }
}

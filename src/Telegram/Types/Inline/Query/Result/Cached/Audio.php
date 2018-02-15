<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to an mp3 audio file stored on the Telegram servers. By default, this audio file will be sent by
 * the user. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the audio.
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedaudio
 */
class Audio extends Result
{
    /**
     * Type of the result, must be audio
     * @var string
     */
    public $type = 'audio';

    /**
     * A valid file identifier for the audio file
     * @var string
     */
    public $audio_file_id = '';

    /**
     * Optional. Audio caption, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

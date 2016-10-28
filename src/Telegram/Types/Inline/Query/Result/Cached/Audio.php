<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Represents a link to an mp3 audio file stored on the Telegram servers. By default, this audio file will be sent by
 * the user. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the audio.
 *
 * Objects defined as-is april 2016
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
}

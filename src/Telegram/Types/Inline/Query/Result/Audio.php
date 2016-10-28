<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Represents a link to an mp3 audio file. By default, this audio file will be sent by the user. Alternatively, you can
 * use input_message_content to send a message with the specified content instead of the audio.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultaudio
 */
class Audio extends Result
{
    /**
     * Type of the result, must be audio
     * @var string
     */
    public $type = 'audio';

    /**
     * A valid URL for the audio file
     * @var string
     */
    public $audio_url = '';

    /**
     * Title of the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Audio caption, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Performer
     * @var string
     */
    public $performer = '';

    /**
     * Optional. Audio duration in seconds
     * @var int
     */
    public $audio_duration = 0;
}

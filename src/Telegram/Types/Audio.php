<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an audio file to be treated as music by the Telegram clients
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#audio
 */
class Audio extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Duration of the audio in seconds as defined by sender
     * @var int
     */
    public $duration = 0;

    /**
     * Optional. Performer of the audio as defined by sender or by audio tags
     * @var string
     */
    public $performer = '';

    /**
     * Optional. Title of the audio as defined by sender or by audio tags
     * @var string
     */
    public $title = '';

    /**
     * Optional. MIME type of the file as defined by sender
     * @var string
     */
    public $mime_type = '';

    /**
     * Optional. File size
     * @var int
     */
    public $file_size = 0;
}

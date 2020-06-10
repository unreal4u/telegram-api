<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an audio file to be treated as music by the Telegram clients
 *
 * Objects defined as-is June 2020, Bot API v4.9
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
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used
     * to download or reuse the file.
     *
     * @var string
     */
    public $file_unique_id = '';

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

    /**
     * Optional. Thumbnail of the album cover to which the music file belongs
     * @var PhotoSize
     */
    public $thumb;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'thumb':
                return new PhotoSize($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#document
 */
class Document extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Optional. Document thumbnail as defined by sender
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Original filename as defined by sender
     * @var string
     */
    public $file_name = '';

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

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'thumb':
                return new PhotoSize($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

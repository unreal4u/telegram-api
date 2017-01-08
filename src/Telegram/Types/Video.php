<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a video file
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#video
 */
class Video extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Video width as defined by sender
     * @var int
     */
    public $width = 0;

    /**
     * Video height as defined by sender
     * @var int
     */
    public $height = 0;

    /**
     * Duration of the video in seconds as defined by sender
     * @var int
     */
    public $duration = 0;

    /**
     * Optional. Video thumbnail
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Mime type of a file as defined by sender
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

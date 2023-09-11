<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#animation
 */
class Animation extends TelegramTypes
{
    /**
     * Unique file identifier
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
     * Optional. Animation thumbnail as defined by sender
     * @var PhotoSize
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Original animation filename as defined by sender
     * @var int
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
            case 'thumbnail':
            case 'thumb':
                return new PhotoSize($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

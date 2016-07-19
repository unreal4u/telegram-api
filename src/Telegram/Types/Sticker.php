<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached\Photo;

/**
 * This object represents a sticker
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sticker
 */
class Sticker extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Photo width
     * @var int
     */
    public $width = 0;

    /**
     * Photo height
     * @var int
     */
    public $height = 0;

    /**
     * Optional. Sticker thumbnail in .webp or .jpg format
     * @var PhotoSize
     */
    public $thumb = null;

    /**
     * Optional. Emoji associated with the sticker
     * @var string
     */
    public $emoji = '';

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

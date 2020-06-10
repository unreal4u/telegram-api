<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a sticker
 *
 * Objects defined as-is may 2020, Bot API v4.9
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
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used
     * to download or reuse the file
     *
     * @var string
     */
    public $file_unique_id = '';

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
     * True, if the sticker is animated
     * @see https://telegram.org/blog/animated-stickers
     *
     * @var bool
     */
    public $is_animated = false;

    /**
     * Optional. Sticker thumbnail in .webp or .jpg format
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Emoji associated with the sticker
     * @var string
     */
    public $emoji = '';

    /**
     * Optional. Name of the sticker set to which the sticker belongs
     * @var string
     */
    public $set_name = '';

    /**
     * Optional. For mask stickers, the position where the mask should be placed
     * @var MaskPosition
     */
    public $mask_position;

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
            case 'mask_position':
                return new MaskPosition($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\StickerSetArray;

/**
 * This object represents a sticker set
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#stickerset
 */
class StickerSet extends TelegramTypes
{
    /**
     * Sticker set name
     * @var string
     */
    public $name = '';

    /**
     * Sticker set title
     * @var string
     */
    public $title = '';

    /**
     * True, if the sticker set contains animated stickers
     * @see https://telegram.org/blog/animated-stickers
     *
     * @var bool
     */
    public $is_animated = false;

    /**
     * True, if the sticker set contains masks
     * @var bool
     */
    public $contains_masks = false;

    /**
     * List of all set stickers
     * @var Sticker[]
     */
    public $stickers = [];

    /**
     * Optional. Sticker set thumbnail in the .WEBP or .TGS format
     * @var PhotoSize[]
     */
    public $thumbnail = [];

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var PhotoSize[]
     */
    public $thumb = [];

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'stickers':
                return new StickerSetArray($data, $this->logger);
            case 'thumbnail':
            case 'thumb':
                return new PhotoSize($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\StickerSetArray;

/**
 * This object represents a sticker set
 *
 * Objects defined as-is july 2017
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
     * True, if the sticker set contains masks
     * @var bool
     */
    public $is_masks = false;

    /**
     * List of all set stickers
     * @var Sticker[]
     */
    public $stickers = [];

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'stickers':
                return new StickerSetArray($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

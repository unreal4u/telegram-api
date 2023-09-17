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
    public const TYPE_REGULAR = 'regular';
    public const TYPE_MASK = 'mask';
    public const TYPE_CUSTOM_EMOJI = 'custom_emoji';

    /**
     * Identifier for this file, which can be used to download or reuse the file
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
     * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent
     * from its format, which is determined by the fields is_animated and is_video.
     *
     * @var string
     */
    public $type = '';

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
     * True, if the sticker is video sticker
     * @see https://telegram.org/blog/video-stickers-better-reactions
     *
     * @var bool
     */
    public $is_video = false;

    /**
     * Optional. Sticker thumbnail in .webp or .jpg format
     * @var PhotoSize
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
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
     * Optional. For premium regular stickers, premium animation for the sticker
     * @var File
     */
    public $premium_animation = '';

    /**
     * Optional. For mask stickers, the position where the mask should be placed
     * @var MaskPosition
     */
    public $mask_position;

    /**
     * Optional. For custom emoji stickers, unique identifier of the custom emoji
     * @var string
     */
    public $custom_emoji_id = '';

    /**
     * Optional. True, if the sticker must be repainted to a text color in messages, the color of the Telegram Premium
     * badge in emoji status, white color on chat photos, or another appropriate color in other places
     * @var bool
     */
    public $needs_repainting = false;

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
            case 'mask_position':
                return new MaskPosition($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

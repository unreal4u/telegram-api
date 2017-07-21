<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet methods
 * (can be used multiple times). Returns the uploaded File on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#uploadstickerfile
 */
class UploadStickerFile extends TelegramMethods
{
    /**
     * User identifier of sticker file owner
     * @var string
     */
    public $user_id = 0;

    /**
     * Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either
     * width or height must be exactly 512px
     * @var InputFile
     */
    public $png_sticker;

    /**
     * Gets the name of all mandatory fields
     * @return array
     */
    public function getMandatoryFields(): array
    {
        return [
            'user_id',
            'png_sticker',
        ];
    }
}

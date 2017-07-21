<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\MaskPosition;

/**
 * Use this method to create new sticker set owned by a user. The bot will be able to edit the created sticker set.
 * Returns True on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#createnewstickerset
 */
class CreateNewStickerSet extends TelegramMethods
{
    /**
     * User identifier of created sticker set owner
     * @var int
     */
    public $user_id = 0;

    /**
     * Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only english
     * letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in
     * "_by_<bot username>". <bot_username> is case insensitive. 1-64 characters
     * @var string
     */
    public $name = '';

    /**
     * Sticker set title, 1-64 characters
     * @var bool
     */
    public $title = '';

    /**
     * Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either
     * width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the
     * Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one
     * using multipart/form-data
     * @var InputFile
     */
    public $png_sticker;

    /**
     * One or more emoji corresponding to the sticker
     * @var string
     */
    public $emojis = '';

    /**
     * Pass True, if a set of mask stickers should be created
     * @var bool
     */
    public $is_masks = false;

    /**
     * Position where the mask should be placed on faces
     * @var MaskPosition
     */
    public $mask_position;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'user_id',
            'name',
            'title',
            'png_sticker',
            'emojis',
        ];
    }
}

<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Generator;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\MaskPosition;

/**
 * Use this method to add a new sticker to a set created by the bot. Returns True on success
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#addstickertoset
 */
class AddStickerToSet extends TelegramMethods
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
     * Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either
     * width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the
     * Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one
     * using multipart/form-data
     * @var string|InputFile
     */
    public $png_sticker;

    /**
     * TGS animation with the sticker, uploaded using multipart/form-data.
     *
     * @see https://core.telegram.org/animated_stickers#technical-requirements for technical requirements
     * @var InputFile
     */
    public $tgs_sticker;

    /**
     * One or more emoji corresponding to the sticker
     * @var string
     */
    public $emojis = '';

    /**
     * Position where the mask should be placed on faces
     * @var MaskPosition
     */
    public $mask_position;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        $return = [
            'user_id',
            'name',
            'emojis',
        ];

        // Define property as mandatory when not filled in
        if (empty($this->png_sticker) && empty($this->tgs_sticker)) {
            $return[] = 'png_sticker';
            $return[] = 'tgs_sticker';
        }

        return $return;
    }

    public function hasLocalFiles(): bool
    {
        return $this->png_sticker instanceof InputFile || $this->tgs_sticker instanceof InputFile;
    }

    public function getLocalFiles(): Generator
    {
        yield 'png_sticker' => $this->png_sticker;
        yield 'tgs_sticker' => $this->tgs_sticker;
    }
}

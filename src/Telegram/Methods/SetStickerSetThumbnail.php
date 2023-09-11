<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Generator;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only.
 * Returns True on success.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#setstickersetthumb
 */
class SetStickerSetThumbnail extends TelegramMethods
{
    /**
     * Sticker set name
     * @var string
     */
    public $name;

    /**
     * User identifier of the sticker set owner
     * @var int
     */
    public $user_id;

    /**
     * A PNG image with the thumbnail, must be up to 128 kilobytes in size and have width and height exactly 100px, or a
     * TGS animation with the thumbnail up to 32 kilobytes in size; see
     * https://core.telegram.org/animated_stickers#technical-requirements for animated sticker technical requirements.
     * Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a
     * String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on
     * Sending Files ». Animated sticker set thumbnail can't be uploaded via HTTP URL.
     *
     * @var InputFile|string
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var InputFile|string
     */
    public $thumb;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'name',
            'user_id',
        ];
    }

    public function hasLocalFiles(): bool
    {
        return $this->thumbnail instanceof InputFile || $this->thumb instanceof InputFile;
    }

    public function getLocalFiles(): Generator
    {
        yield from [
            'thumbnail' => $this->thumbnail,
            'thumb' => $this->thumb,
        ];
    }
}

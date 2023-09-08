<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMedia;

use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Represents a photo to be sent.
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#inputmediaphoto
 */
class Document extends InputMedia
{
    /**
     * Type of the result, must be photo
     * @var string
     */
    public $type = 'document';

    /**
     * Optional. Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A
     * thumbnail's width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>"
     * if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     * @var InputFile|string
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var InputFile|string
     */
    public $thumb;

    /**
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntityArray
     */
    public $caption_entities;

    /**
     * Optional. Disables automatic server-side content type detection for files uploaded using multipart/form-data.
     * Always true, if the document is sent as part of an album
     * @var bool
     */
    public $disable_content_type_detection;
}

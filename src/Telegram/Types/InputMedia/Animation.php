<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMedia;

use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Represents a video to be sent.
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inputmediavideo
 */
class Animation extends InputMedia
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'animation';

    /**
     * Optional. Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A
     * thumbnail's width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>"
     * if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     * @var InputFile
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var string|InputFile
     */
    public $thumb;

    /**
     * Optional. Animation width
     * @var int
     */
    public $width = 0;

    /**
     * Optional. Animation height
     * @var int
     */
    public $height = 0;

    /**
     * Optional. Duration of the audio in seconds
     * @var int
     */
    public $duration = 0;
}

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
class Audio extends InputMedia
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'audio';

    /**
     * Optional. Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A
     * thumbnail's width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>"
     * if the thumbnail was uploaded using multipart/form-data under <file_attach_name>.
     * @var InputFile
     */
    public $thumbnail;

    /**
     * @deprecated use $thumbnail instead
     * @var InputFile
     */
    public $thumb;

    /**
     * Optional. Duration of the audio in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Optional. Performer of the audio
     * @var string
     */
    public $performer = '';

    /**
     * Optional. Title of the audio
     * @var string
     */
    public $title = '';
}

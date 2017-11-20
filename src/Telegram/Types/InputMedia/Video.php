<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMedia;

use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Represents a video to be sent.
 *
 * Objects defined as-is november 2017
 *
 * @see https://core.telegram.org/bots/api#inputmediavideo
 */
class Video extends InputMedia
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'video';

    /**
     * Optional. Video width
     * @var int
     */
    public $width = 0;

    /**
     * Optional. Video height
     * @var int
     */
    public $height = 0;

    /**
     * Optional. Video duration
     * @var int
     */
    public $duration = 0;
}

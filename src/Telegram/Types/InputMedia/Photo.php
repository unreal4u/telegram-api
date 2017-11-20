<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMedia;

use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Represents a photo to be sent.
 *
 * Objects defined as-is november 2017
 *
 * @see https://core.telegram.org/bots/api#inputmediaphoto
 */
class Photo extends InputMedia
{
    /**
     * Type of the result, must be photo
     * @var string
     */
    public $type = 'photo';
}

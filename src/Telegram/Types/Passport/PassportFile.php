<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Passport;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents information about an order
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class PassportFile extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * File size
     * @var int
     */
    public $file_size = 0;

    /**
     * Unix time when the file was uploaded
     * @var int
     */
    public $file_date = 0;
}

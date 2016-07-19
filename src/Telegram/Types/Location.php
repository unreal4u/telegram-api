<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a point on the map
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#photosize
 */
class Location extends TelegramTypes
{
    /**
     * Longitude as defined by sender
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Latitude as defined by sender
     * @var float
     */
    public $latitude = 0.0;
}

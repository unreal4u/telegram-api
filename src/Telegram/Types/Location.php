<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a point on the map
 *
 * Objects defined as-is november 2020, Bot API v5.0
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

    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float
     */
    public $horizontal_accuracy = 0.0;

    /**
     * Optional. Time relative to the message sending date, during which the location can be updated, in seconds. For
     * active live locations only
     * @var int
     */
    public $live_period;

    /**
     * Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only
     * @var int
     */
    public $heading;

    /**
     * Optional. Maximum distance for proximity alerts about approaching another chat member, in meters. For sent live
     * locations only
     * @var int
     */
    public $proximity_alert_radius;
}

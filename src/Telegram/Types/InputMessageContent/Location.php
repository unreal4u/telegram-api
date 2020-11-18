<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * Objects defined as-is october 2017
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 *
 * @see https://core.telegram.org/bots/api#inputlocationmessagecontent
 */
class Location extends InputMessageContent
{
    /**
     * Latitude of the location in degrees
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Longitude of the location in degrees
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400
     * @var int
     */
    public $live_period = 0;

    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float
     */
    public $horizontal_accuracy = 0.0;

    /**
     * Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if
     * specified
     * @var int
     */
    public $heading;

    /**
     * Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in
     * meters. Must be between 1 and 100000 if specified.
     * @var int
     */
    public $proximity_alert_radius;

}

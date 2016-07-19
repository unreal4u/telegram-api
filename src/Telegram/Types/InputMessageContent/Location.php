<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * Objects defined as-is july 2015
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
}

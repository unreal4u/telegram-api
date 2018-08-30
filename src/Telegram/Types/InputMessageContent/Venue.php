<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * Objects defined as-is july 2015
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 *
 * @see https://core.telegram.org/bots/api#inputvenuemessagecontent
 */
class Venue extends InputMessageContent
{
    /**
     * Latitude of the venue in degrees
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Longitude of the venue in degrees
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Name of the venue
     * @var string
     */
    public $title = '';

    /**
     * Address of the venue
     * @var string
     */
    public $address = '';

    /**
     * Optional. Foursquare identifier of the venue, if known
     * @var string
     */
    public $foursquare_id = '';

    /**
     * Optional. Foursquare type of the venue. (For example, "arts_entertainment/default", "arts_entertainment/aquarium"
     * or "food/icecream".)
     * @var string
     */
    public $foursquare_type = '';
}

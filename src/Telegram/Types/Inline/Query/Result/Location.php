<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the location.
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultlocation
 */
class Location extends Result
{
    /**
     * Type of the result, must be location
     * @var string
     */
    public $type = 'location';

    /**
     * Location latitude in degrees
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Location longitude in degrees
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Title for the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @var float
     */
    public $horizontal_accuracy = 0.0;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400
     * @var int
     */
    public $live_period = 0;

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

    /**
     * Optional. Url of the thumbnail for the result
     * @var string
     */
    public $thumbnail_url = '';

    /**
     * @deprecated Use $thumbnail_url instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var string
     */
    public $thumb_url = '';

    /**
     * Optional. Width of the thumbnail
     * @var int
     */
    public $thumbnail_width = 0;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var int
     */
    public $thumb_width = 0;

    /**
     * Optional. Height of the thumbnail
     * @var int
     */
    public $thumbnail_height = 0;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var int
     */
    public $thumb_height = 0;

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

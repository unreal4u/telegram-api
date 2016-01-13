<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractTelegramMethods;

/**
 * Object that resembles a message object in Telegram
 *
 * @see https://core.telegram.org/bots/api#sendlocation
 */
class SendLocation extends AbstractTelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Latitude of location
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Longitude of location
     * @var float
     */
    public $longitude = 0.0;

    /**
     * If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to
     * hide keyboard or to force a reply from the user.
     * @var null
     */
    public $reply_markup = null;
}

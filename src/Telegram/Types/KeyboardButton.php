<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents one button of the reply keyboard. For simple text buttons String can be used instead of this
 * object to specify text of the button. Optional fields are mutually exclusive.
 *
 * Note: request_contact and request_location options will only work in Telegram versions released after 9 April, 2016.
 * Older clients will ignore them.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#keyboardbutton
 */
class KeyboardButton extends TelegramTypes
{
    /**
     * Text of the button. If none of the optional fields are used, it will be sent to the bot as a message when the
     * button is pressed
     * @var string
     */
    public $text = '';

    /**
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in
     * private chats only
     * @var bool
     */
    public $request_contact = false;

    /**
     * Optional. If True, the user's current location will be sent when the button is pressed. Available in private
     * chats only
     * @var bool
     */
    public $request_location = false;
}

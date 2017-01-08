<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method to send phone contacts. On success, the sent Message is returned.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sendcontact
 */
class SendContact extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Contact's phone number
     * @var string
     */
    public $phone_number = '';

    /**
     * Contact's first name
     * @var string
     */
    public $first_name = '';

    /**
     * Contact's last name
     * @var string
     */
    public $last_name = '';

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to
     * hide keyboard or to force a reply from the user.
     * @var KeyboardMethods
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'phone_number',
            'first_name',
        ];
    }
}

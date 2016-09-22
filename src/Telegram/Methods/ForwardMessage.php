<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Object that resembles a message object in Telegram
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#forwardmessage
 */
class ForwardMessage extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Unique identifier for the chat where the original message was sent (or channel username in the
     * format @channelusername)
     * @var string
     */
    public $from_chat_id = '';

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * Unique message identifier
     * @var int
     */
    public $message_id = 0;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'from_chat_id',
            'message_id',
        ];
    }
}

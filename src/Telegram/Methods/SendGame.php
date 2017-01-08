<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;

/**
 * Use this method to send a game. On success, the sent Message is returned.
 *
 * Objects defined as-is December 2016
 *
 * @see https://core.telegram.org/bots/api#sendgame
 */
class SendGame extends TelegramMethods
{
    /**
     * Unique identifier for the target chat
     * @var int
     */
    public $chat_id = 0;

    /**
     * Short name of the game, serves as the unique identifier for the game. Set up your games via Botfather.
     * @var float
     */
    public $game_short_name = '';

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
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'game_short_name',
        ];
    }
}

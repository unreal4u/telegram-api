<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method to send point on the map. On success, the sent Message is returned.
 *
 * Objects defined as-is june 2019
 *
 * @see https://core.telegram.org/bots/api#stoppoll
 */
class StopPoll extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername). A
     * native poll can't be sent to a private chat
     * @var string
     */
    public $chat_id = '';

    /**
     * Identifier of the original message with the poll
     * @var int
     */
    public $message_id;

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
            'message_id',
        ];
    }
}

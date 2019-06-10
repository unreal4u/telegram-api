<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use function json_encode;

/**
 * Use this method to send point on the map. On success, the sent Message is returned.
 *
 * Objects defined as-is june 2019
 *
 * @see https://core.telegram.org/bots/api#sendpoll
 */
class SendPoll extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername). A
     * native poll can't be sent to a private chat
     * @var string
     */
    public $chat_id = '';

    /**
     * Poll question, 1-255 characters
     * @var string
     */
    public $question = '';

    /**
     * List of answer options, 2-10 strings 1-100 characters each
     * @var string[]
     */
    public $options = [];

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
            'question',
            'options',
        ];
    }

    public function performSpecialConditions(): TelegramMethods
    {
        $this->options = json_encode($this->options);
        return parent::performSpecialConditions();
    }
}

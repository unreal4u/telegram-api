<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;

/**
 * Object that resembles a message object in Telegram
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sendmessage
 */
class SendMessage extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Text of the message to be sent
     * @var string
     */
    public $text = '';

    /**
     * Optional. Send Markdown, if you want Telegram apps to show bold, italic and inline URLs in your bot's message.
     * For the moment, only Telegram for Android supports this.
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Disables link previews for links in this message
     * @var bool
     */
    public $disable_web_page_preview = false;

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * Optional. If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to
     * hide keyboard or to force a reply from the user
     * @var KeyboardMethods
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'text',
        ];
    }
}

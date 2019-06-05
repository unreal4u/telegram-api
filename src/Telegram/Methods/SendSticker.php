<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Generator;
use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send .webp stickers. On success, the sent Message is returned.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sendsticker
 */
class SendSticker extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Sticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass
     * an HTTP URL as a String for Telegram to get a .webp file from the Internet, or upload a new one using the
     * InputFile class
     * @see InputFile
     * @var string|InputFile
     */
    public $sticker = '';

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
            'sticker',
        ];
    }

    public function hasLocalFiles(): bool
    {
        return $this->sticker instanceof InputFile;
    }

    public function getLocalFiles(): Generator
    {
        yield 'sticker' => $this->sticker;
    }
}

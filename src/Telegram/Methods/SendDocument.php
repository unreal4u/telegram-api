<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any
 * type of up to 50 MB in size, this limit may be changed in the future.
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#senddocument
 */
class SendDocument extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an
     * HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using the InputFile class
     *
     * @see InputFile
     * @var string|InputFile
     */
    public $document = '';

    /**
     * Optional. Document caption (may also be used when resending documents by file_id), 0-200 characters
     * @var string
     */
    public $caption = '';

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
            'document',
        ];
    }
}

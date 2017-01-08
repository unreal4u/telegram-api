<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send photos. On success, the sent Message is returned
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#sendphoto
 */
class SendPhoto extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass
     * an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using the InputFile
     * class.
     * @see InputFile
     * @var string|InputFile
     */
    public $photo = '';

    /**
     * Optional. Photo caption (may also be used when resending photos by file_id)
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
     * @var null
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'photo',
        ];
    }
}

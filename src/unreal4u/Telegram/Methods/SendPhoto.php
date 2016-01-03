<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;
use unreal4u\InternalFunctionality\MethodDefinitions;

/**
 * Use this method to send photos. On success, the sent Message is returned
 *
 * @see https://core.telegram.org/bots/api#sendphoto
 */
class SendPhoto extends AbstractMethodFunctions implements MethodDefinitions
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Photo to send. You can either pass a file_id as String to resend a photo that is already on the Telegram servers,
     * or upload a new photo using multipart/form-data.
     * @var string
     */
    public $photo = '';

    /**
     * Optional. Photo caption (may also be used when resending photos by file_id)
     * @var string
     */
    public $caption = '';

    /**
     * Optional. If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to hide
     * keyboard or to force a reply from the user
     * @var null
     */
    public $reply_markup = null;

    public static function apiMethod(): string
    {
        return 'sendPhoto';
    }

    public static function requiresMultipartForm(): bool
    {
        return true;
    }
}

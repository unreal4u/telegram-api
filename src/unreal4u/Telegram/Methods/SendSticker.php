<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;
use unreal4u\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send .webp stickers. On success, the sent Message is returned.
 *
 * @see https://core.telegram.org/bots/api#sendsticker
 */
class SendSticker extends AbstractMethodFunctions
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Sticker to send. You can either pass a file_id as String to resend a sticker that is already on the Telegram
     * servers, or upload a new sticker using the InputFile class
     * @see unreal4u\Telegram\Types\Custom\InputFile.
     * @var InputFile
     */
    public $sticker = null;

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
    public $reply_markup = null;
}

<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\Abstracts\TelegramMethods;
use unreal4u\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
 * For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or
 * Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size,
 * this limit may be changed in the future.
 *
 * @see https://core.telegram.org/bots/api#sendvoice
 */
class SendVoice extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Audio file to send. You can either pass a file_id as String to resend an audio that is already on the Telegram
     * servers, or upload a new audio file using the InputFile class
     * @see unreal4u\Telegram\Types\Custom\InputFile
     * @var InputFile
     */
    public $voice = null;

    /**
     * Optional. Duration of sent video in seconds
     * @var int
     */
    public $duration = 0;

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

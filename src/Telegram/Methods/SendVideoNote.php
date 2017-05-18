<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video
 * messages. On success, the sent Message is returned
 *
 * Objects defined as-is May 2017
 *
 * @see https://core.telegram.org/bots/api#sendvideonote
 */
class SendVideoNote extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers
     * (recommended) or upload a new video using multipart/form-data. Sending video notes by a URL is currently
     * unsupported
     * @see InputFile
     * @see https://core.telegram.org/bots/api#sending-files
     * @var string|InputFile
     */
    public $video_note = '';

    /**
     * Optional. Duration of sent video in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Video width and height
     * @var int
     */
    public $length = 0;

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
            'video_note',
        ];
    }
}

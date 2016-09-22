<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On
 * success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be
 * changed in the future.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sendvideo
 */
class SendVideo extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Video to send. You can either pass a file_id as String to resend a video that is already on the Telegram servers,
     * or upload a new video file using the InputFile class
     * @see unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile
     * @var InputFile
     */
    public $video = null;

    /**
     * Optional. Duration of sent video in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Video width
     * @var int
     */
    public $width = 0;

    /**
     * Video height
     * @var int
     */
    public $height = 0;

    /**
     * Video caption (may also be used when resending videos by file_id).
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
    public $reply_markup = null;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'video',
        ];
    }
}

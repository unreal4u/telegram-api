<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On
 * success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be
 * changed in the future.
 *
 * @see https://core.telegram.org/bots/api#sendvideo
 */
class SendVideo extends AbstractMethodFunctions
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Video to send. You can either pass a file_id as String to resend a video that is already on the Telegram servers,
     * or upload a new video file using curl's @ notation.
     * @var string
     */
    public $video = '';

    /**
     * Optional. Duration of sent video in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Video caption (may also be used when resending videos by file_id).
     * @var string
     */
    public $caption = '';

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

    public static function requiresMultipartForm(): bool
    {
        return true;
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Generator;
use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On
 * success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be
 * changed in the future.
 *
 * Objects defined as-is February 2018
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
     * Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass
     * an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using the InputFile
     * class
     * @see InputFile
     * @var string|InputFile
     */
    public $video = '';

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
     *
     * @var InputFile
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var InputFile
     */
    public $thumb;

    /**
     * Video caption (may also be used when resending videos by file_id).
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption
     * @var string
     */
    public $parse_mode = '';

    /**
     * Pass True, if the uploaded video is suitable for streaming
     * @var bool
     */
    public $supports_streaming = false;

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
     * Optional. Pass True if the message should be sent even if the specified replied-to message is not found
     * @var bool
     */
    public $allow_sending_without_reply = false;

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
            'video',
        ];
    }

    public function hasLocalFiles(): bool
    {
        return $this->video instanceof InputFile;
    }

    public function getLocalFiles(): Generator
    {
        yield 'video' => $this->video;
    }
}

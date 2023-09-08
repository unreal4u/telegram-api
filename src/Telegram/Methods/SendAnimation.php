<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message
 * is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
 *
 * Objects defined as-is July 2018
 *
 * @see https://core.telegram.org/bots/api#sendanimation
 */
class SendAnimation extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Animation to send. Pass a file_id as String to send an animation that exists on the Telegram servers
     * (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new
     * one using the InputFile class
     *
     * @see InputFile
     * @var string|InputFile
     */
    public $animation = '';

    /**
     * Duration of sent animation in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Animation width
     * @var int
     */
    public $width = 0;

    /**
     * Animation height
     * @var int
     */
    public $height = 0;

    /**
     * Optional. Thumbnail of the file sent. The thumbnail should be in JPEG format and less than 200 kB in size. A
     * thumbnail's width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data.
     * Thumbnails can't be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>"
     * if the thumbnail was uploaded using multipart/form-data under <file_attach_name>
     * @var string|InputFile
     */
    public $thumbnail;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var string|InputFile
     */
    public $thumb;

    /**
     * Optional. Animation caption (may also be used when resending animation by file_id), 0-200 characters
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
            'animation',
        ];
    }
}

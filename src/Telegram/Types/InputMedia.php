<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents the content of a media message to be sent. It should be one of:
 *
 * InputMediaPhoto
 * InputMediaVideo
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inputmedia
 */
abstract class InputMedia extends TelegramTypes
{
    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL
     * for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using
     * multipart/form-data under <file_attach_name> name.
     *
     * @var string
     */
    public $media = '';

    /**
     * Optional. Caption of the photo to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption
     * @var string
     */
    public $parse_mode = '';
}

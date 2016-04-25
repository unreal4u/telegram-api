<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively,
 * you can provide message_text to send it instead of photo.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultphoto
 */
class InlineQueryResultPhoto extends InlineQueryResult
{
    /**
     * Type of the result, must be photo
     * @var string
     */
    public $type = 'photo';

    /**
     * A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
     * @var string
     */
    public $photo_url = '';

    /**
     * Optional. Width of the photo
     * @var int
     */
    public $photo_width = 0;

    /**
     * Optional. Height of the photo
     * @var int
     */
    public $photo_height = 0;

    /**
     * URL of the thumbnail for the photo
     * @var string
     */
    public $thumb_url = '';

    /**
     * Optional. Title for the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';

    /**
     * Optional. Caption of the photo to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Text of a message to be sent instead of the photo, 1-512 characters
     * @var string
     */
    public $message_text = '';

    /**
     * Optional. Send “Markdown”, if you want Telegram apps to show bold, italic and inline URLs in your bot's message
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Disables link previews for links in the sent message
     * @var bool
     */
    public $disable_web_page_preview = false;
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively,
 * you can provide message_text to send it instead of photo.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvideo
 */
class InlineQueryResultVideo extends InlineQueryResult
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'video';

    /**
     * A valid URL for the embedded video player or video file
     * @var string
     */
    public $video_url = '';

    /**
     * Mime type of the content of video url, “text/html” or “video/mp4”
     * @var string
     */
    public $mime_type = '';

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

    /**
     * Optional. Video width
     * @var int
     */
    public $video_width = 0;

    /**
     * Optional. Video height
     * @var int
     */
    public $video_height = 0;

    /**
     * Optional. Video duration in seconds
     * @var int
     */
    public $video_duration = 0;

    /**
     * URL of the thumbnail (jpeg only) for the video
     * @var string
     */
    public $thumb_url = '';

    /**
     * Title for the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';
}

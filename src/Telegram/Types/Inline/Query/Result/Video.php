<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be
 * sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with
 * the specified content instead of the video.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvideo
 */
class Video extends Result
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
     * Optional. Caption of the video to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

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
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

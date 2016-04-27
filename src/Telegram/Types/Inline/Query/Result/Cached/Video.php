<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by the
 * user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified
 * content instead of the video.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedvideo
 */
class Video extends Result
{
    /**
     * Type of the result, must be video
     * @var string
     */
    public $type = 'video';

    /**
     * A valid file identifier for the video file
     * @var string
     */
    public $video_file_id = '';

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

    /**
     * Optional. Caption of the video to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';
}

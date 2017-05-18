<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound). By default, this animated MPEG-4 file
 * will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message
 * with the specified content instead of the animation.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 */
class Mpeg4Gif extends Result
{
    /**
     * Type of the result, must be mpeg4_gif
     * @var string
     */
    public $type = 'mpeg4_gif';

    /**
     * A valid URL for the MP4 file. File size must not exceed 1MB
     * @var string
     */
    public $mpeg4_url = '';

    /**
     * Optional. Video width
     * @var int
     */
    public $mpeg4_width = 0;

    /**
     * Optional. Video height
     * @var int
     */
    public $mpeg4_height = 0;

    /**
     * Optional. Video duration
     * @var int
     */
    public $mpeg4_duration = 0;

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
     * Optional. Caption of the MPEG-4 file to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional
 * caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the
 * animation.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgif
 */
class Gif extends Result
{
    /**
     * Type of the result, must be gif
     * @var string
     */
    public $type = 'gif';

    /**
     * A valid URL for the GIF file. File size must not exceed 1MB
     * @var string
     */
    public $gif_url = '';

    /**
     * Optional. Width of the GIF
     * @var int
     */
    public $gif_width = 0;

    /**
     * Optional. Height of the GIF
     * @var int
     */
    public $gif_height = 0;

    /**
     * Optional. Duration of the GIF
     * @var int
     */
    public $gif_duration = 0;

    /**
     * URL of the static thumbnail for the result (jpeg or gif)
     * @var string
     */
    public $thumb_url = '';

    /**
     * Optional. Title for the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Caption of the GIF file to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

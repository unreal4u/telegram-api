<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional
 * caption. Alternatively, you can provide message_text to send it instead of the animation.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgif
 */
class InlineQueryResultGif extends InlineQueryResult
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
     * Optional. Text of a message to be sent instead of the animation, 1-512 characters
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

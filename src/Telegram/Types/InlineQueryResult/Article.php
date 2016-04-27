<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InlineQueryResult;

use unreal4u\TelegramAPI\Telegram\Types\InlineQueryResult;

/**
 * Represents a link to an article or web page
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 */
class Article extends InlineQueryResult
{
    /**
     * Type of the result, must be article
     * @var string
     */
    public $type = 'article';

    /**
     * Title of the result
     * @var string
     */
    public $title = '';

    /**
     * Text of the message to be sent
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
     * Optional. URL of the result
     * @var string
     */
    public $url = '';

    /**
     * Optional. Pass True, if you don't want the URL to be shown in the message
     * @var bool
     */
    public $hide_url = false;

    /**
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';

    /**
     * Optional. Url of the thumbnail for the result
     * @var string
     */
    public $thumb_url = '';

    /**
     * Optional. Thumbnail width
     * @var int
     */
    public $thumb_width = 0;

    /**
     * Optional. Thumbnail height
     * @var int
     */
    public $thumb_height = 0;
}

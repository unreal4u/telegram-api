<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to an article or web page
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 */
class Article extends Result
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
    public $thumbnail_url = '';

    /**
     * @deprecated Use $thumbnail_url instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var string
     */
    public $thumb_url = '';

    /**
     * Optional. Thumbnail width
     * @var int
     */
    public $thumbnail_width = 0;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var int
     */
    public $thumb_width = 0;

    /**
     * Optional. Thumbnail height
     * @var int
     */
    public $thumbnail_height = 0;

    /**
     * @deprecated Use $thumbnail instead (Bot API 6.6, March 9, 2023 https://core.telegram.org/bots/api-changelog#march-9-2023)
     * @var int
     */
    public $thumb_height = 0;

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

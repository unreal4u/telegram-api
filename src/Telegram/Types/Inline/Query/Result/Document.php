<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the file. Currently, only
 * .PDF and .ZIP files can be sent using this method.
 *
 * Objects defined as-is February 2018
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultdocument
 */
class Document extends Result
{
    /**
     * Type of the result, must be document
     * @var string
     */
    public $type = 'document';

    /**
     * Title of the result
     * @var string
     */
    public $title = '';

    /**
     * Optional. Caption of the document to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption
     * @var string
     */
    public $parse_mode = '';

    /**
     * A valid URL for the file
     * @var string
     */
    public $document_url = '';

    /**
     * Mime type of the content of the file, either “application/pdf” or “application/zip”
     * @var string
     */
    public $mime_type = '';

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

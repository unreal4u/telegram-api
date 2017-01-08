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
 * Objects defined as-is april 2016
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

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content;
}

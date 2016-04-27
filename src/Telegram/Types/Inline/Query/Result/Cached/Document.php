<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Represents a link to a file stored on the Telegram servers. By default, this file will be sent by the user with an
 * optional caption. Alternatively, you can use input_message_content to send a message with the specified content
 * instead of the file. Currently, only pdf-files and zip archives can be sent using this method.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcacheddocument
 */
class Document extends Result
{
    /**
     * Type of the result, must be document
     * @var string
     */
    public $type = 'document';

    /**
     * Title for the result
     * @var string
     */
    public $title = '';

    /**
     * A valid file identifier for the file
     * @var string
     */
    public $document_file_id = '';

    /**
     * Optional. Short description of the result
     * @var string
     */
    public $description = '';

    /**
     * Optional. Caption of the document to be sent, 0-200 characters
     * @var string
     */
    public $caption = '';
}

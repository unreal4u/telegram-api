<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Cached;

use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result;

/**
 * Represents a link to a sticker stored on the Telegram servers. By default, this sticker will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the sticker.
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 */
class Sticker extends Result
{
    /**
     * Type of the result, must be sticker
     * @var string
     */
    public $type = 'sticker';

    /**
     * A valid file identifier for the audio file
     * @var string
     */
    public $sticker_file_id = '';
}

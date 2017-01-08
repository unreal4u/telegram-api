<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * You can provide an animation for your game so that it looks stylish in chats (check out Lumberjack for an example).
 * This object represents an animation file to be displayed in the message containing a game
 *
 * Objects defined as-is December 2016
 *
 * @see https://core.telegram.org/bots/api#animation
 */
class Animation extends TelegramTypes
{
    /**
     * Unique file identifier
     * @var string
     */
    public $file_id = '';

    /**
     * Optional. Animation thumbnail as defined by sender
     * @var PhotoSize
     */
    public $thumb;

    /**
     * Optional. Original animation filename as defined by sender
     * @var int
     */
    public $file_name = '';

    /**
     * Optional. MIME type of the file as defined by sender
     * @var string
     */
    public $mime_type = '';

    /**
     * Optional. File size
     * @var int
     */
    public $file_size = 0;
}

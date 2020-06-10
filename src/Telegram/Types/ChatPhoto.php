<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a chat photo
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#chatphoto
 */
class ChatPhoto extends TelegramTypes
{
    /**
     * Unique file identifier of small (160x160) chat photo. This file_id can be used only for photo download.
     * @var User
     */
    public $small_file_id = '';

    /**
     * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for
     * different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    public $small_file_unique_id = '';

    /**
     * Unique file identifier of big (640x640) chat photo. This file_id can be used only for photo download
     * @var string
     */
    public $big_file_id = '';

    /**
     * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different
     * bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    public $big_file_unique_id = '';
}

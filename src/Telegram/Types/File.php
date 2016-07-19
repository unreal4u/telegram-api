<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link
 * https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1
 * hour. When the link expires, a new one can be requested by calling getFile.
 * <blockquote>Maximum file size to download is 20 MB</blockquote>
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#file
 */
class File extends TelegramTypes
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Optional. File size, if known
     * @var int
     */
    public $file_size = 0;

    /**
     * Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
     * @var string
     */
    public $file_path = '';
}

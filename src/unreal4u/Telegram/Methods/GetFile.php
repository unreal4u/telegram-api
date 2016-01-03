<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
 * files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link
 * https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed
 * that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile
 * again.
 *
 * @see https://core.telegram.org/bots/api#getfile
 */
class GetFile extends AbstractMethodFunctions
{
    /**
     * File identifier to get info about
     * @var string
     */
    public $file_id = '';

    public static function apiMethod(): string
    {
        return 'getFile';
    }

    /**
     * This call will return an array with updates, so call up a custom type to do this
     *
     * @return string
     */
    public static function bindToObjectType(): string
    {
        return 'File';
    }
}

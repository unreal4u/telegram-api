<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\File;

/**
 * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
 * files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link
 * https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed
 * that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile
 * again.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getfile
 */
class GetFile extends TelegramMethods
{
    /**
     * File identifier to get info about
     * @var string
     */
    public $file_id = '';

    /**
     * This call will return an array with updates, so call up a custom type to do this
     *
     * @param TelegramRawData $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new File($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'file_id',
        ];
    }
}

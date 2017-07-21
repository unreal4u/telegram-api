<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to delete a sticker from a set created by the bot. Returns True on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#deletestickerfromset
 */
class DeleteStickerFromSet extends TelegramMethods
{
    /**
     * File identifier of the sticker
     * @var string
     */
    public $sticker = '';

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'sticker',
        ];
    }
}

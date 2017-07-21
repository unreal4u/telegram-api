<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to move a sticker in a set created by the bot to a specific position . Returns True on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#setstickerpositioninset
 */
class SetStickerPositionInSet extends TelegramMethods
{
    /**
     * File identifier of the sticker
     * @var string
     */
    public $sticker = '';

    /**
     * New sticker position in the set, zero-based
     * @var string
     */
    public $position = 0;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'sticker',
            'position',
        ];
    }
}

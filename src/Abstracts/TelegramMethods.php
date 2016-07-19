<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Interfaces\TelegramMethodDefinitions;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Contains methods that all Telegram methods should implement
 */
abstract class TelegramMethods implements TelegramMethodDefinitions
{
    /**
     * Most of the methods will return a Message object on success, so set that as default.
     *
     * @param array $data
     * @param LoggerInterface $logger
     *
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new Message($data->getResult(), $logger);
    }

    /**
     * Before making the actual request this method will be called
     *
     * It must be used to json_encode stuff, or do other changes in the internal class representation before sending it
     * to the Telegram servers
     *
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods
    {
        if (!empty($this->reply_markup)) {
            $this->reply_markup = json_encode($this->reply_markup);
        }

        return $this;
    }
}

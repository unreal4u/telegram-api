<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Interfaces;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

/**
 * Mandatory functions for Methods
 *
 * @package unreal4u\TelegramAPI\Interfaces
 */
interface TelegramMethodDefinitions
{
    /**
     * Most of the methods will instantiate a Message object, this method can override the default behaviour
     *
     * @param TelegramRawData $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes;

    /**
     * Performs special work that needs to be done on the fields before sending it to Telegram
     *
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods;

    /**
     * Will check and export all mandatory fields, will also add non-mandatory fields if they have any values
     *
     * @return array
     */
    public function export(): array;

    /**
     * Gets the name of all mandatory fields
     * @return array
     */
    public function getMandatoryFields(): array;
}

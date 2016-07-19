<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Interfaces;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

interface TelegramMethodDefinitions
{
    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes;

    public function performSpecialConditions(): TelegramMethods;
}

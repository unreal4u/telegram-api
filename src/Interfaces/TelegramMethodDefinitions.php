<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Interfaces;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

interface TelegramMethodDefinitions
{
    public static function bindToObjectType(): string;

    public function performSpecialConditions(): TelegramMethods;
}

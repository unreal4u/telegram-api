<?php

declare(strict_types = 1);

namespace unreal4u\Interfaces;

use unreal4u\Abstracts\TelegramMethods;

interface TelegramMethodDefinitions
{
    public static function bindToObjectType(): string;

    public function performSpecialConditions(): TelegramMethods;
}

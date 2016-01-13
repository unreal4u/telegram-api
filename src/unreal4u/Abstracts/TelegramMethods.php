<?php

declare(strict_types = 1);

namespace unreal4u\Abstracts;

use unreal4u\Interfaces\TelegramMethodDefinitions;

/**
 * Contains methods that all Telegram methods should implement
 */
abstract class TelegramMethods implements TelegramMethodDefinitions
{
    /**
     * Most of the methods will return a Message object on success, so set that as default.
     *
     * @return string
     */
    public static function bindToObjectType(): string
    {
        return 'Message';
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

/**
 * Methods that all Telegram methods should implement
 */
abstract class AbstractMethodFunctions implements MethodDefinitions
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

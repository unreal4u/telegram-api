<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

abstract class AbstractMethodFunctions implements MethodDefinitions
{
    public static function bindToObjectType(): string
    {
        return 'Message';
    }

    public static function requiresMultipartForm(): bool
    {
        return false;
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

/**
 *
 * Class AbstractMethodFunctions
 * @package unreal4u\InternalFunctionality
 */
abstract class AbstractMethodFunctions implements MethodDefinitions
{
    /**
     * Most of the methods will return a Message object on success, so set it as default.
     *
     * @return string
     */
    public static function bindToObjectType(): string
    {
        return 'Message';
    }

    /**
     * Most of the methods don't require a multipart form data type, so set the default to false.
     *
     * @return bool
     */
    public static function requiresMultipartForm(): bool
    {
        return false;
    }
}

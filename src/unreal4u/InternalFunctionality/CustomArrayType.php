<?php

namespace unreal4u\InternalFunctionality;

/**
 * Used in all custom types that are an array
 */
interface CustomArrayType
{
    public function __construct(array $data = null);

    public function traverseObject();
}

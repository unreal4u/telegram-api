<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

/**
 * Special class to which to ask if we're dealing with a native type or a custom one
 *
 * Most of the custom ones do need some work after they have been set, so this will be an easy way to distinguish
 * between the two.
 */
abstract class CustomType extends TelegramTypes
{
    public $data = [];
}

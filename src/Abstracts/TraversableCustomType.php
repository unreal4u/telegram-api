<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

/**
 * Class TraversableType
 * @package unreal4u\TelegramAPI\Abstracts
 */
abstract class TraversableCustomType extends CustomType implements \IteratorAggregate
{
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->data);
    }
}

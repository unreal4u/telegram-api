<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use ArrayIterator;
use Generator;
use IteratorAggregate;
use Traversable;

/**
 * Class TraversableCustomType
 * @package unreal4u\TelegramAPI\Abstracts
 */
abstract class TraversableCustomType extends CustomType implements IteratorAggregate
{
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Traverses through our $data, yielding the result set, can return any type of object
     * @return Generator|TelegramTypes
     */
    final public function traverseObject(): Generator
    {
        yield from $this->data;
    }
}

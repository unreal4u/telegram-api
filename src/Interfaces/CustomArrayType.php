<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Interfaces;

use Psr\Log\LoggerInterface;

/**
 * Used in all custom types that are an array
 */
interface CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null);

    public function traverseObject();
}

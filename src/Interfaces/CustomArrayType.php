<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Interfaces;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Used in all custom types that are an array
 */
interface CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null, TelegramResponse $response = null);

    public function traverseObject();
}

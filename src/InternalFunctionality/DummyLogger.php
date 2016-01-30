<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

use Psr\Log\LoggerInterface;

/**
 * Special class that will act as backup in case no logger is given
 *
 * As the name implies, this class won't do anything except declare the methods so we can still call them in this API.
 */
class DummyLogger implements LoggerInterface
{
    public function emergency($message, array $context = array()): bool
    {
        return false;
    }

    public function alert($message, array $context = array()): bool
    {
        return false;
    }

    public function critical($message, array $context = array()): bool
    {
        return false;
    }

    public function error($message, array $context = array()): bool
    {
        return false;
    }

    public function warning($message, array $context = array()): bool
    {
        return false;
    }

    public function notice($message, array $context = array()): bool
    {
        return false;
    }

    public function info($message, array $context = array()): bool
    {
        return false;
    }

    public function debug($message, array $context = array()): bool
    {
        return false;
    }

    public function log($level, $message, array $context = array()): bool
    {
        return false;
    }
}

<?php
declare(strict_types = 1);

namespace unreal4u\Telegram\Types\Custom;

/**
 * Some APIs (mainly inline bots) respond with boolean types
 */
class ResultBoolean
{
    public $data = false;

    public function __construct(bool $result)
    {
        $this->data = $result;
    }
}

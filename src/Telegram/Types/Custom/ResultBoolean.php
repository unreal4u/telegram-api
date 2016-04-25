<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use Psr\Log\LoggerInterface;

/**
 * Some APIs (mainly inline bots) respond with boolean types
 */
class ResultBoolean extends TelegramTypes
{
    public $data = false;

    public function __construct(bool $result, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->data = $result;
    }
}

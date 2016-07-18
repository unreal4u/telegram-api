<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use Psr\Log\LoggerInterface;

/**
 * Some API calls respond with int types
 */
class ResultInt extends TelegramTypes
{
    public $data = 0;

    public function __construct(int $result, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->data = $result;
    }

    public function __toString()
    {
        return (string)$this->data;
    }
}

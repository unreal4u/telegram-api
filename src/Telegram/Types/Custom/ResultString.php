<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use Psr\Log\LoggerInterface;

/**
 * Some API calls respond with int types
 */
class ResultString extends CustomType
{
    public $data = '';

    public function __construct(string $result, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->data = $result;
    }

    public function __toString()
    {
        return (string)$this->data;
    }
}

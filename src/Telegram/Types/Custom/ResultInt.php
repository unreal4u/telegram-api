<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Some API calls respond with int types
 */
class ResultInt extends CustomType
{
    public $data = 0;

    public function __construct(int $result, LoggerInterface $logger = null, TelegramResponse $response = null)
    {
        $this->data = $result;
        parent::__construct(null, $logger, $response);
    }

    public function __toString()
    {
        return (string)$this->data;
    }
}

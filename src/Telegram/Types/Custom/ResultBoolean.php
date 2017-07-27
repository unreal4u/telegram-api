<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Some APIs (mainly inline bots) respond with boolean types
 */
class ResultBoolean extends CustomType
{
    public $data = false;

    public function __construct(bool $result, LoggerInterface $logger = null, TelegramResponse $response = null)
    {
        $this->data = $result;
        parent::__construct(null, $logger, $response);
    }

    /**
     * I don't really use this function, but I can imagine it can come in handy when PHP handles the casting internally
     * @return string
     */
    public function __toString()
    {
        if ($this->data === true) {
            return '1';
        } else {
            return '0';
        }
    }
}

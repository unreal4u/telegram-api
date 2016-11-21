<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use Psr\Log\LoggerInterface;

/**
 * Mainly used if we have no clue what type of (new?) object the API is returning us
 */
class ResultArray extends CustomType
{
    /**
     * @var string
     */
    public $data = '';

    public function __construct(array $result, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->data = json_encode($result);
    }

    /**
     * Return the data
     * @return string
     */
    public function __toString()
    {
        return $this->data;
    }
}

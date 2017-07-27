<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Mainly used if we have no clue what type of (new?) object the API is returning us
 */
class ResultArray extends TraversableCustomType
{
    /**
     * @var string
     */
    public $data = '';

    public function __construct(array $result, LoggerInterface $logger = null, TelegramResponse $response = null)
    {
        $this->logger = $logger;
        $this->data = $result;

        parent::__construct($result, $logger, $response);
    }

    /**
     * Return the data
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }
}

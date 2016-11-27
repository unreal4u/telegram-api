<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use Psr\Log\LoggerInterface;

/**
 * Not being used by the package itself, but useful for some bots to initialize if no response is actually expected
 */
class ResultNull extends CustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * I don't really use this function, but I can imagine it can come in handy when PHP handles the casting internally
     * @return string
     */
    public function __toString()
    {
        return null;
    }
}

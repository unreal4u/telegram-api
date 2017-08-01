<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\CustomType;

/**
 * Not being used by the package itself, but useful for some bots to initialize if no response is actually expected
 */
class ResultNull extends CustomType
{
    public function __construct(array $result = null, LoggerInterface $logger = null)
    {
        $this->data = $result;
    }
}

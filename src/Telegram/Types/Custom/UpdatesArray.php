<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use unreal4u\TelegramAPI\Telegram\Types\Update;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class UpdatesArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new Update($telegramResponse, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return Update[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $update) {
            yield $update;
        }
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Telegram\Types\MessageEntity;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class MessageEntityArray extends CustomType implements CustomArrayType
{
    public $data = [];

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (!empty($data)) {
            foreach ($data as $id => $messageEntity) {
                $this->data[$id] = new MessageEntity($messageEntity, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return \Generator
     */
    public function traverseObject()
    {
        foreach ($this->data as $messageEntity) {
            yield $messageEntity;
        }
    }
}

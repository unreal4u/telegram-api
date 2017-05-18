<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class UserArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $chatMember) {
                $this->data[$id] = new User($chatMember, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return ChatMember[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $user) {
            yield $user;
        }
    }
}

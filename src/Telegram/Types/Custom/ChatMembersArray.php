<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Mockup class to generate a real telegram update representation
 */
class ChatMembersArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $chatMember) {
                $this->data[$id] = new ChatMember($chatMember, $logger);
            }
        }
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\MessageEntity;

/**
 * Mockup class to generate a real telegram update representation
 */
class MessageEntityArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null, TelegramResponse $response = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $messageEntity) {
                $this->data[$id] = new MessageEntity($messageEntity, $logger);
            }
        }

        parent::__construct(null, $logger, $response);
    }
}

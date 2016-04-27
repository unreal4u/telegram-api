<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Telegram\Types\InlineKeyboardButton;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class InlineKeyboardButtonArray implements CustomArrayType
{
    public $data = [];

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (!empty($data)) {
            foreach ($data as $id => $photo) {
                $this->data[$id] = new InlineKeyboardButton();
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
        foreach ($this->data as $inlineKeyboardButton) {
            yield $inlineKeyboardButton;
        }
    }
}

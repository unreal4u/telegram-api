<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Button;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class InlineKeyboardButtonArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $rowId => $buttons) {
                $rowButtons = [];
                foreach ($buttons as $button) {
                    $rowButtons[] = new Button($button, $logger);
                }
                $this->data[$rowId] = $rowButtons;
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return Button[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $inlineKeyboardButton) {
            yield $inlineKeyboardButton;
        }
    }
}

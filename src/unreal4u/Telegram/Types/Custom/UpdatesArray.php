<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types\Custom;

use unreal4u\Abstracts\TelegramTypes;
use unreal4u\Interfaces\CustomArrayType;
use unreal4u\Telegram\Types\Update;

/**
 * Mockup class to generate a real telegram update representation
 */
class UpdatesArray extends TelegramTypes implements CustomArrayType
{
    public $data = [];

    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new Update($telegramResponse);
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
        foreach ($this->data as $update) {
            yield $update;
        }
    }
}

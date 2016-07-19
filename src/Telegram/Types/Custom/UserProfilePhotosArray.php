<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use unreal4u\TelegramAPI\Telegram\Types\PhotoSize;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class UserProfilePhotosArray extends CustomType implements CustomArrayType
{
    public $data = [];

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (!empty($data)) {
            $i = 0;
            foreach ($data as $telegramResponse) {
                foreach ($telegramResponse as $photoSize) {
                    // Create an actual PhotoSize object and fill the array
                    $this->data[$i][] = new PhotoSize($photoSize, $logger);
                }
                $i++;
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
        foreach ($this->data as $data) {
            yield $data;
        }
    }
}

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
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            $i = 0;
            /** @var array $telegramResponse */
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
     * @return PhotoSize[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $data) {
            yield $data;
        }
    }
}

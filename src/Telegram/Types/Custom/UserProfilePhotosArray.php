<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\Telegram\Types\PhotoSize;

/**
 * Mockup class to generate a real telegram update representation
 */
class UserProfilePhotosArray extends TraversableCustomType
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
}

<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types\Custom;

use unreal4u\Telegram\Types\PhotoSize;

/**
 * Mockup class to generate a real telegram update representation
 */
class UserProfilePhotosArray
{
    public $data = [];

    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            foreach ($data as $telegramResponse) {
                foreach ($telegramResponse as $photoSize) {
                    // Create an actual PhotoSize object and fill the array
                    $this->data[] = new PhotoSize($photoSize);
                }
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return \Generator
     */
    public function traverseUpdates()
    {
        foreach ($this->data as $update) {
            yield $update;
        }
    }
}

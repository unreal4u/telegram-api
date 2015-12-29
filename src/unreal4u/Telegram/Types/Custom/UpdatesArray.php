<?php

namespace unreal4u\Telegram\Types\Custom;

use unreal4u\Telegram\Types\Update;

/**
 * Mockup class to generate a real telegram update representation
 */
class UpdatesArray
{
    public $data = [];

    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object
                $update = new Update($telegramResponse);

                // And fill in the array
                $this->data[] = $update;
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

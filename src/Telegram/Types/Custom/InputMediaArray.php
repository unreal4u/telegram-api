<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Used for methods that will return an array of messages
 */
class InputFileArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (\count($data) !== 0) {
            foreach ($data as $inputmedia) {
                $this->data[] = new InputMedia($inputmedia);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return Update[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $inputmedia) {
            yield $inputmedia;
        }
    }
}

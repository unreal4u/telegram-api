<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Telegram\Types\Passport\PassportFile;
use unreal4u\TelegramAPI\Telegram\Types\PhotoSize;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;

/**
 * Mockup class to generate a real telegram update representation
 */
class PassportFileArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $passportFile) {
                $this->data[$id] = new PassportFile($passportFile, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return PhotoSize[]
     */
    public function traverseObject(): \Generator
    {
        foreach ($this->data as $passportFile) {
            yield $passportFile;
        }
    }
}

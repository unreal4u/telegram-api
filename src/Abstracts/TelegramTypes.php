<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\Dummy\Logger;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultArray;

#[\AllowDynamicProperties]
abstract class TelegramTypes
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new Logger();
        }

        $this->logger = $logger;
        if ($data !== null) {
            $this->populateObject($data);
        }
    }

    /**
     * Fills the class with the data passed on through the constructor
     *
     * @param array $data
     * @return TelegramTypes
     */
    final protected function populateObject(array $data = []): TelegramTypes
    {
        foreach ($data as $key => $value) {
            $candidateKey = null;
            if (\is_array($value)) {
                $this->logger->debug('Array detected, mapping subobjects for key', ['key' => $key]);
                $candidateKey = $this->mapSubObjects($key, $value);
            }

            if (!empty($candidateKey)) {
                if ($candidateKey instanceof CustomType) {
                    $this->logger->debug('Done with mapping, injecting custom data type to class', ['key' => $key]);
                    $this->$key = $candidateKey->data;
                } else {
                    $this->logger->debug('Done with mapping, injecting native data type to class', ['key' => $key]);
                    $this->$key = $candidateKey;
                }
            } else {
                $this->logger->debug('Performing direct assign for key', ['key' => $key]);
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * The default is that we have no subobjects at all, so this function will return nothing
     *
     * @return TelegramTypes
     */
    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        if (!isset($this->$key)) {
            $this->logger->error(sprintf(
                'The key "%s" does not exist in the class %s! Maybe a recent Telegram Bot API update? In any way, please '.
                'submit an issue (bug report) at %s with this complete log line',
                $key,
	            static::class,
                'https://github.com/unreal4u/telegram-api/issues',
            ), [
                'object' => static::class,
                'data' => $data,
            ]);
        }

        return new ResultArray($data, $this->logger);
    }
}

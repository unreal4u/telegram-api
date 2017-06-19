<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultArray;

abstract class TelegramTypes
{
    protected $logger;

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
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
            if (is_array($value)) {
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
     * @param string $key
     * @param array $data
     *
     * @return TelegramTypes
     */
    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        if (!isset($this->$key)) {
            $this->logger->error(sprintf(
                'The key "%s" does not exist in the class! Maybe a recent Telegram Bot API update? In any way, please '.
                'submit an issue (bug report) at %s with this complete log line',
                $key,
                'https://github.com/unreal4u/telegram-api/issues'
            ), [
                'object' => get_class($this),
                'data' => $data,
            ]);
        }

        return new ResultArray($data);
    }
}

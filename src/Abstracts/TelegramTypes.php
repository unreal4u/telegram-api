<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;

abstract class TelegramTypes
{
    protected $logger = null;

    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (is_null($logger)) {
            $logger = new DummyLogger();
        }

        $this->logger = $logger;
        $this->populateObject($data);
    }

    /**
     * Fills the class with the data passed on through the constructor
     *
     * @param \stdClass $data
     * @return TelegramTypes
     */
    final protected function populateObject(array $data = null): TelegramTypes
    {
        if (!is_null($data)) {
            $this->logger->debug('Detected data, mapping subobjects');
            $subObjects = $this->mapSubObjects();
            foreach ($data as $key => $value) {
                if (!empty($subObjects) && array_key_exists($key, $subObjects)) {
                    $className = 'unreal4u\\TelegramAPI\\Telegram\\Types\\' . $subObjects[$key];
                    $this->logger->debug(sprintf('Subobject detected, creating new instance of %s', $className));
                    $candidateKey = new $className($value, $this->logger);
                    if (isset($candidateKey->data)) {
                        $this->logger->debug('Injecting custom data type to class');
                        $this->$key = $candidateKey->data;
                    } else {
                        $this->logger->debug('Injecting instance to class');
                        $this->$key = $candidateKey;
                    }
                } else {
                    $this->logger->debug(sprintf('Direct assign: key: %s', $key));
                    $this->$key = $value;
                }
            }
        }

        return $this;
    }

    /**
     * The default is that we have no subobjects at all
     *
     * @return array
     */
    protected function mapSubObjects(): array
    {
        return [];
    }
}

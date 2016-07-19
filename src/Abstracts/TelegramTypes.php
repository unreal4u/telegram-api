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
     * @param array $data
     * @return TelegramTypes
     */
    final protected function populateObject(array $data = null): TelegramTypes
    {
        if (!is_null($data)) {
            $this->logger->debug('Detected incoming data on object, foreaching the general data', [
                'object' => get_class($this)
            ]);
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
        return null;
    }
}

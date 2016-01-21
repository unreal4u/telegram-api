<?php

declare(strict_types = 1);

namespace unreal4u\Abstracts;

abstract class TelegramTypes
{
    public function __construct(array $data = null)
    {
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
            $subObjects = $this->mapSubObjects();
            foreach ($data as $key => $value) {
                if (!empty($subObjects) && array_key_exists($key, $subObjects)) {
                    $className = 'unreal4u\\Telegram\\Types\\' . $subObjects[$key];
                    $candidateKey = new $className($value);
                    if (isset($candidateKey->data)) {
                        $this->$key = $candidateKey->data;
                    } else {
                        $this->$key = $candidateKey;
                    }
                } else {
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

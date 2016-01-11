<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

abstract class AbstractFiller
{
    public function __construct(\stdClass $data = null)
    {
        $this->populateObject($data);
    }

    final protected function populateObject(\stdClass $data = null): AbstractFiller
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

<?php

declare(strict_types = 1);

namespace unreal4u\InternalFunctionality;

abstract class Filler
{
    final protected function populateObject(\stdClass $data = null): Filler
    {
        if (!is_null($data)) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }

        return $this;
    }
}

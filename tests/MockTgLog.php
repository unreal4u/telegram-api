<?php

namespace tests;

use unreal4u\TgLog;

class MockTgLog extends TgLog
{
    protected function sendRequestToTelegram($method, array $formData): \stdClass
    {
        $this->composeApiMethodUrl($method);

        $filename = sprintf(
            'tests/MockData/%s.txt',
            $this->methodName
        );

        return json_decode(file_get_contents($filename));
    }
}

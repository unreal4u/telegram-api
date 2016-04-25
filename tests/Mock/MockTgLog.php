<?php

namespace tests\Mock;

use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

class MockTgLog extends TgLog
{
    /**
     * Methods can give several types of output, fill in a specific test here
     * @var string
     */
    public $specificTest = '';

    /**
     * Must be set on true to throw a new exception
     * @var bool
     */
    public $mockException = false;

    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): array
    {
        $this->composeApiMethodUrl($method);

        $connector = '';
        if (!empty($this->specificTest)) {
            $connector = '-';
        }

        $filename = sprintf(
            'tests/Mock/MockData/%s%s%s.txt',
            $this->methodName,
            $connector,
            $this->specificTest
        );

        if ($this->mockException) {
            throw new MockClientException(file_get_contents($filename));
        }

        return json_decode(file_get_contents($filename), true);
    }
}

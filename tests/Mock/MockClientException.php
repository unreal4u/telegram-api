<?php

namespace unreal4u\TelegramAPI\tests\Mock;

class MockClientException extends \Exception
{
    public $decodedResponse = null;

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->decodedResponse = json_decode($message);

        parent::__construct($message, $code, $previous);
    }
}

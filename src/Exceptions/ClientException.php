<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Exceptions;

use unreal4u\TelegramAPI\Telegram\Types\Custom\UnsuccessfulRequest;
use unreal4u\TelegramAPI\Telegram\Types\ResponseParameters;

class ClientException extends \Exception
{
    /**
     * @var UnsuccessfulRequest
     */
    protected $errorRequest = null;

    /**
     * @var ResponseParameters
     */
    protected $parameters = null;

    public function setParameters(ResponseParameters $responseParameters): ClientException
    {
        $this->parameters = $responseParameters;
        return $this;
    }

    public function setError(UnsuccessfulRequest $unsuccessfulRequest): ClientException
    {
        $this->errorRequest = $unsuccessfulRequest;
        return $this;
    }

    public function getParameters(): ResponseParameters
    {
        return $this->parameters;
    }

    public function getError(): UnsuccessfulRequest
    {
        return $this->errorRequest;
    }
}

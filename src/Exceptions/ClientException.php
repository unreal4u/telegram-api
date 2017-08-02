<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Exceptions;

use Throwable;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UnsuccessfulRequest;

class ClientException extends \RuntimeException
{
    /**
     * @var UnsuccessfulRequest
     */
    protected $errorRequest;

    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        if ($previous !== null) {
            $this->file = $previous->getFile();
            $this->line = $previous->getLine();

            $this->setError(new UnsuccessfulRequest([
                'description' => $previous->getMessage(),
                'error_code' => $previous->getCode(),
            ]));
        }
    }

    public function setError(UnsuccessfulRequest $unsuccessfulRequest): ClientException
    {
        $this->errorRequest = $unsuccessfulRequest;

        $this->message = $unsuccessfulRequest->description;
        $this->code = $unsuccessfulRequest->error_code;
        return $this;
    }

    public function getError(): UnsuccessfulRequest
    {
        return $this->errorRequest;
    }
}

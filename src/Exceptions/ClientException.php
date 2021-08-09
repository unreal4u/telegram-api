<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Exceptions;

use React\Http\Message\ResponseException;
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

    /**
     * Construct a new ClientException with the parameters and, if present, body
     * found in the given ResponseException.
     *
     * @param  \React\Http\Message\ResponseException  $responseException
     *
     * @return static
     */
    public static function fromResponseException(ResponseException $responseException): self {
        $exception = new ClientException(
            $responseException->getMessage(),
            $responseException->getCode(),
            $responseException
        );

        $body    = $responseException->getResponse()->getBody()->getContents();
        $decoded = json_decode($body, true);

        if (is_array($decoded)
            && array_key_exists('description', $decoded)
            && array_key_exists('error_code', $decoded)
        ) {
            $exception->setError(new UnsuccessfulRequest($decoded));
        }

        return $exception;
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

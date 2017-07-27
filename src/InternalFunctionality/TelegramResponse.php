<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use unreal4u\TelegramAPI\Exceptions\InvalidResultType;

class TelegramResponse
{
    /**
     * Nothing is done so far with this, but it's always a good idea to have the original around
     * @var string
     */
    private $rawData = '';

    /**
     * The actual representation of the decoded data
     * @var array
     */
    private $decodedData = [];

    /**
     * The headers sent with the response.
     * @var array
     */
    private $headers = [];

    /**
     * @var \Exception
     */
    private $exception = null;

    /**
     * Marks the actual response as an error
     * @var bool
     */
    private $isError = false;

    public function __construct(string $rawData, array $headers = [], \Exception $e = null)
    {
        $this->fillRawData($rawData);
        $this->headers = $headers;

        if (!is_null($e)) {
            $this->exception = $e;
            $this->isError = true;
        }
    }

    /**
     * Will return true if the request was an unsuccessful one, false otherwise
     * @return bool
     */
    public function isError(): bool
    {
        return $this->isError;
    }

    /**
     * Fills in the raw data
     *
     * @param string $rawData
     * @return TelegramResponse
     */
    public function fillRawData(string $rawData): TelegramResponse
    {
        $this->rawData = $rawData;
        $this->decodedData = json_decode($this->rawData, true);

        return $this;
    }

    /**
     * To quickly find out what type of request we are dealing with
     *
     * Unused so far
     *
     * @return string
     * @throws InvalidResultType
     */
    public function getTypeOfResult(): string
    {
        switch (gettype($this->decodedData['result'])) {
            case 'array':
            case 'integer':
            case 'boolean':
                return gettype($this->decodedData['result']);
            default:
                throw new InvalidResultType(
                    sprintf('The passed data type ("%s") is not supported', gettype($this->decodedData['result']))
                );
        }
    }

    /**
     * Most of the requests Telegram sends, come as an array, so send the response back as an array by default
     *
     * @return array
     */
    public function getResult(): array
    {
        return array_key_exists('result', $this->decodedData) ? (array) $this->decodedData['result'] : [];
    }

    /**
     * Hack: for some requests Telegram sends back an array, integer, string or a boolean value, convert it to boolean
     * here
     * @return bool
     */
    public function getResultBoolean(): bool
    {
        return array_key_exists('result', $this->decodedData) ? (bool) $this->decodedData['result'] : false;
    }

    /**
     * Hack: for some requests Telegram send back an array, integer, string or a boolean value, convert it to int here
     * @return int
     */
    public function getResultInt(): int
    {
        return array_key_exists('result', $this->decodedData) ? (int)$this->decodedData['result'] : -1;
    }

    /**
     * Hack: for some requests Telegram send back an array, integer, string or a boolean value, convert it to string
     * here
     * @return string
     */
    public function getResultString(): string
    {
        return array_key_exists('result', $this->decodedData) ? (string)$this->decodedData['result'] : '';
    }

    /**
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns the raw error data
     * @return array
     */
    public function getErrorData(): array
    {
        return $this->decodedData;
    }

    /**
     * @return \Exception
     */
    public function getException(): \Exception
    {
        return $this->exception;
    }
}

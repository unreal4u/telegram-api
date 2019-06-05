<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\Exceptions\InvalidResultType;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UnsuccessfulRequest;

class TelegramResponse
{
    /**
     * Used in the TelegramDocument class, saves some processing
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
    private $headers;

    public function __construct(string $rawData, array $headers = [])
    {
        $this->fillRawData($rawData);
        $this->headers = $headers;
    }

    /**
     * Fills in the raw data
     *
     * @param string $rawData
     * @return TelegramResponse
     * @throws ClientException
     */
    public function fillRawData(string $rawData): TelegramResponse
    {
        $this->rawData = $rawData;
        $this->decodedData = json_decode($this->rawData, true);

        if ($this->decodedData['ok'] === false) {
            $exception = new ClientException();
            $exception->setError(new UnsuccessfulRequest($this->decodedData));
            throw $exception;
        }

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
        return (array)$this->decodedData['result'];
    }

    /**
     * Hack: for some requests Telegram sends back an array, integer, string or a boolean value, convert it to boolean
     * here
     * @return bool
     */
    public function getResultBoolean(): bool
    {
        return (bool)$this->decodedData['result'];
    }

    /**
     * Hack: for some requests Telegram send back an array, integer, string or a boolean value, convert it to int here
     * @return int
     */
    public function getResultInt(): int
    {
        return (int)$this->decodedData['result'];
    }

    /**
     * Hack: for some requests Telegram send back an array, integer, string or a boolean value, convert it to string
     * here
     * @return string
     */
    public function getResultString(): string
    {
        return (string)$this->decodedData['result'];
    }

    /**
     * @return string
     */
    public function getRawData(): string
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
}

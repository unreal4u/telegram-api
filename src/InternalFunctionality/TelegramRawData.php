<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use unreal4u\TelegramAPI\Exceptions\InvalidResultType;

class TelegramRawData
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

    public function __construct(string $rawData)
    {
        $this->rawData = $rawData;
        $this->decodedData = json_decode($this->rawData, true);
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
}

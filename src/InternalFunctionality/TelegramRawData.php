<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

class TelegramRawData
{
    /**
     * Nothing is done so far with this
     * @var string
     */
    private $rawData = '';

    /**
     * The actual representation of the decoded data
     * @var array
     */
    public $decodedData = [];

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
     */
    public function getTypeOfResult(): string
    {
        if (is_array($this->decodedData['result'])) {
            return 'array';
        }

        if (is_integer($this->decodedData['result'])) {
            return 'int';
        }

        if (is_bool($this->decodedData['result'])) {
            return 'bool';
        }
    }

    /**
     * Hack: for most of the requests Telegram sends back an array, so send the response back as an array
     *
     * @return array
     */
    public function getResult(): array
    {
        return (array)$this->decodedData['result'];
    }

    /**
     * Hack: for some requests Telegram sends back an array, integer or a boolean value, convert it to boolean
     * @return bool
     */
    public function getResultBoolean(): bool
    {
        return (bool)$this->decodedData['result'];
    }

    /**
     * Hack: for some requests Telegram send back an array, integer or a boolean value, convert it to int
     * @return int
     */
    public function getResultInt(): int
    {
        return (int)$this->decodedData['result'];
    }
}

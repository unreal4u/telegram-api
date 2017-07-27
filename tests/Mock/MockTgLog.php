<?php

namespace unreal4u\TelegramAPI\tests\Mock;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise\Promise;
use Psr\Log\LoggerInterface;
use React\Promise\PromiseInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\TgLog;


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

    public function __construct($botToken, LoggerInterface $logger = null)
    {
        $handler = new MockRequestHandler();
        parent::__construct($botToken, $handler, $logger);
    }

    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): PromiseInterface
    {
        $this->composeApiMethodUrl($method);

        $connector = '';
        if (!empty($this->specificTest)) {
            $connector = '-';
        }

        $filename = sprintf(
            'tests/Mock/MockData/%s%s%s.json',
            $this->methodName,
            $connector,
            $this->specificTest
        );

        // TODO Convert this to the MockHandler here below
        if ($this->mockException) {
            throw new MockClientException(file_get_contents($filename));
        }

        return $this->requestHandler->post($filename, $formData);
    }

    public function composeApiMethodUrl(TelegramMethods $call): string
    {
        return parent::composeApiMethodUrl($call);
    }

    public function getTestTypeResponse(string $name): array
    {
        $returnData = [];
        $filename = sprintf('tests/Mock/MockData/Types/%s.json', $name);

        if (file_exists($filename)) {
            $returnData = json_decode(file_get_contents($filename), true);
        }

        if (empty($returnData)) {
            throw new \Exception('Empty returnData, please fix your test');
        }

        return $returnData;
    }
}

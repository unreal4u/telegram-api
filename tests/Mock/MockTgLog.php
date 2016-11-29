<?php

namespace unreal4u\TelegramAPI\tests\Mock;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
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

    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): TelegramRawData
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

        $guzzleMocker = new MockHandler([new Response(200, [], file_get_contents($filename))]);
        $handler = HandlerStack::create($guzzleMocker);

        $this->httpClient = new Client(['handler' => $handler]);

        return parent::sendRequestToTelegram($method, $formData);
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

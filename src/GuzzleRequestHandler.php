<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

class GuzzleRequestHandler implements RequestHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * GuzzleRequestHandler constructor.
     *
     * @param ClientInterface $client
     * @param LoggerInterface $logger
     */
    public function __construct(ClientInterface $client = null, LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;

        if ($client === null) {
            $client = new Client();
        }
        $this->httpClient = $client;
    }

    /**
     * @param string $uri
     * @param array $formData
     *
     * @return PromiseInterface
     */
    public function post(string $uri, array $formData = []): PromiseInterface
    {
        $this->logger->debug('About to perform async HTTP call to Telegram\'s API');
        $deferred = new Deferred();

        $promise = $this->httpClient->postAsync($uri, $formData);
        $promise->then(
            function (ResponseInterface $response) use ($deferred) {
                $deferred->resolve(new TelegramResponse((string)$response->getBody()));
            },
            function (RequestException $exception) use ($deferred) {
                if (!empty($exception->getResponse()->getBody())) {
                    $deferred->resolve(new TelegramResponse((string)$exception->getResponse()
                        ->getBody(), $exception));
                } else {
                    $deferred->reject($exception);
                }
            }
        );

        return $deferred->promise();
    }

    /**
     * @param string $uri
     *
     * @return PromiseInterface
     */
    public function get(string $uri): PromiseInterface
    {
        $this->logger->debug('About to perform async HTTP call to Telegram\'s API');
        $deferred = new Deferred();

        $promise = $this->httpClient->getAsync($uri);
        $promise->then(
            function (ResponseInterface $response) use ($deferred) {
                $deferred->resolve(new TelegramResponse((string)$response->getBody()));
            },
            function (RequestException $exception) use ($deferred) {
                if (!empty($exception->getResponse()->getBody())) {
                    $deferred->resolve(new TelegramResponse((string)$exception->getResponse()
                        ->getBody(), $exception));
                } else {
                    $deferred->reject($exception);
                }
            }
        );

        return $deferred->promise();
    }
}

<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use Exception;
use React\EventLoop\LoopInterface;
use React\HttpClient\Client;
use React\HttpClient\Request;
use React\HttpClient\Response;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use React\Socket\Connector;
use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

class HttpClientRequestHandler implements RequestHandlerInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * HttpClientRequestHandler constructor.
     * @param LoopInterface $loop
     * @param array $options Use this to set options such as DNS and alike
     */
    public function __construct(LoopInterface $loop, array $options = [])
    {
        $this->client = new Client($loop, new Connector($loop, $options));
    }

    /**
     * @param string $uri
     * @return PromiseInterface
     */
    public function get(string $uri): PromiseInterface
    {
        $request = $this->client->request('GET', $uri);
        return $this->processRequest($request);
    }

    /**
     * @param string $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function post(string $uri, array $options): PromiseInterface
    {
        $headers = !empty($options['headers']) ? $options['headers'] : [];
        $request = $this->client->request('POST', $uri, $headers);
        return $this->processRequest($request, (!empty($options['body']) ? $options['body'] : null));
    }

    /**
     * @param Request $request
     * @param mixed $data
     * @return PromiseInterface
     */
    public function processRequest(Request $request, $data = null): PromiseInterface
    {
        $deferred = new Deferred();

        $receivedData = '';
        $request->on('response', static function (Response $response) use ($deferred, &$receivedData) {
            $response->on('data', static function ($chunk) use (&$receivedData) {
                $receivedData .= $chunk;
            });

            $response->on('end', static function () use (&$receivedData, $deferred, $response) {
                try {
                    $endResponse = new TelegramResponse($receivedData, $response->getHeaders());
                    $deferred->resolve($endResponse);
                } catch (Exception $e) {
                    // Capture any exceptions thrown from TelegramResponse and reject the response
                    $deferred->reject($e);
                }
            });
        });

        $request->on('error', static function (Exception $e) use ($deferred) {
            $deferred->reject(new ClientException($e->getMessage(), $e->getCode(), $e));
        });

        $request->end($data);

        return $deferred->promise();
    }
}

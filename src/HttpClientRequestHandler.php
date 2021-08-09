<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use Exception;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use React\Http\Browser;
use React\Http\Message\ResponseException;
use React\Promise\PromiseInterface;
use React\Socket\Connector;
use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * Class HttpClientRequestHandler
 *
 * This class implements a request handler based on the react/http package.
 *
 * @package unreal4u\TelegramAPI
 */
class HttpClientRequestHandler implements RequestHandlerInterface
{

    /**
     * @var Browser
     */
    protected $client;

    /**
     * HttpClientRequestHandler constructor.
     *
     * @param  LoopInterface  $loop
     * @param  array  $options  the options to pass to the socket connector
     *
     * @see https://github.com/reactphp/socket#connector
     */
    public function __construct(LoopInterface $loop, array $options = [])
    {
        $this->client = new Browser($loop, new Connector($loop, $options));
    }

    /**
     * Performs a GET request against the given URI
     *
     * @param  string  $uri
     *
     * @return PromiseInterface with a TelegramResponse on fulfill or exception on reject
     */
    public function get(string $uri): PromiseInterface
    {
        return $this->processRequest($this->client->get($uri));
    }

    /**
     * Performs a POST request against the given uri, with the given options
     *
     * @param  string  $uri
     * @param  array  $options an array consisting of request options; known keys include 'headers' and 'body'.
     *
     * @return PromiseInterface with a TelegramResponse on fulfill or exception on reject
     */
    public function post(string $uri, array $options): PromiseInterface
    {
        return $this->processRequest(
            $this->client->post(
                $uri,
                $options['headers'] ?? [],
                $options['body'] ?? null
            )
        );
    }

    /**
     * Processes and unwraps an incoming request.
     *
     * @param  \React\Promise\PromiseInterface  $request
     *
     * @return PromiseInterface with a TelegramResponse on fulfill or exception on reject
     */
    public function processRequest(PromiseInterface $request): PromiseInterface
    {
        return $request->then(
            // Promise fulfilled
            static function (ResponseInterface $response) {
                return new TelegramResponse(
                    $response->getBody()->getContents(),
                    $response->getHeaders()
                );
            },
            // Promise rejected
            static function (Exception $e) {
                if ($e instanceof ResponseException) {
                    throw ClientException::fromResponseException($e);
                }

                throw new ClientException($e->getMessage(), $e->getCode(), $e);
            }
        );
    }
}

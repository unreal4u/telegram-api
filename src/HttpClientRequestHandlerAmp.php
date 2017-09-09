<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use Amp\Artax\DefaultClient;
use Amp\Artax\Request;
use Amp\Artax\Response;
use Amp\Promise;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

/**
 * @param Promise $promise
 * @return \React\Promise\PromiseInterface
 */
function reactAdapt(Promise $promise)
{
    $deferred = new Deferred();

    $promise->onResolve(function ($error = null, $result = null) use ($deferred) {
        if ($error) {
            $deferred->reject($error);
        } else {
            $deferred->resolve($result);
        }
    });

    return $deferred->promise();
}

class HttpClientRequestHandlerAmp implements RequestHandlerInterface
{

    /**
     * @var DefaultClient
     */
    private $client;

    public function __construct()
    {
        $this->client = new DefaultClient;
    }

    /**
     * @param string $uri
     *
     * @return PromiseInterface
     * @throws \unreal4u\TelegramAPI\Exceptions\ClientException
     */
    public function get(string $uri): PromiseInterface
    {
        $request = new Request($uri);

        return $this->processRequest($request);
    }

    /**
     * @param string $uri
     * @param array $formFields
     *
     * @return PromiseInterface
     * @throws \unreal4u\TelegramAPI\Exceptions\ClientException
     */
    public function post(string $uri, array $formFields): PromiseInterface
    {
        $request = new Request($uri, 'POST');

        if (!empty($formFields['headers'])) {
            $request = $request->withHeaders($formFields['headers']);
        }

        if (!empty($formFields['body'])) {
            $request = $request->withBody($formFields['body']);
        }

        return $this->processRequest($request);
    }

    /**
     * @param Request $request
     *
     * @return PromiseInterface
     * @throws \unreal4u\TelegramAPI\Exceptions\ClientException
     */
    public function processRequest(Request $request)
    {
        return reactAdapt(\Amp\call(function () use ($request) {
            /** @var Response $response */
            $response = yield $this->client->request($request);

            if ($response->getStatus() >= 400) {
                throw new ClientException($response->getReason(), $response->getStatus());
            }

            return new TelegramResponse(yield $response->getBody(), $response->getHeaders());
        }));
    }
}

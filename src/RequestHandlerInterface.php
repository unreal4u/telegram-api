<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI;

use React\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

interface RequestHandlerInterface
{
    /**
     * This is the method that actually makes the call, which can be easily overwritten so that our unit tests can work
     *
     * @param string $uri
     * @param array $formFields
     *
     * @return TelegramRawData
     *
     */
    public function post(string $uri, array $formFields): TelegramRawData;

    /**
     * @param string $uri
     *
     * @return ResponseInterface
     */
    public function get(string $uri): ResponseInterface;

    /**
     * @param string $uri
     * @param array $formFields
     *
     * @return PromiseInterface
     */
    public function postAsync(string $uri, array $formFields): PromiseInterface;

    /**
     * @param string $uri
     *
     * @return PromiseInterface
     */
    public function getAsync(string $uri): PromiseInterface;
}

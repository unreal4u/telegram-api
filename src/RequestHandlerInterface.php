<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

interface RequestHandlerInterface
{
    /**
     * This is the method that actually makes the call, which can be easily overwritten so that our unit tests can work
     *
     * @param string $uri
     * @param array $formData
     *
     * @return TelegramRawData
     */
    public function request(string $uri, array $formData): TelegramRawData;

    /**
     * @param string $uri
     *
     * @return ResponseInterface
     */
    public function get(string $uri): ResponseInterface;

    /**
     * @param string $uri
     * @param array $formData
     * 
     * @return PromiseInterface
     */
    public function requestAsync(string $uri, array $formData): PromiseInterface;
}
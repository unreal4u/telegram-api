<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI;

use React\Promise\PromiseInterface;

interface RequestHandlerInterface
{
    /**
     * @param string $uri
     * @param array $formFields
     *
     * @return PromiseInterface
     */
    public function post(string $uri, array $formFields): PromiseInterface;

    /**
     * @param string $uri
     *
     * @return PromiseInterface
     */
    public function get(string $uri): PromiseInterface;
}

<?php

declare(strict_types = 1);

namespace unreal4u;

use \GuzzleHttp\Client;

/**
 * Handler for Monolog
 */
class TelegramLog
{
    /**
     * Stores the token
     * @var string
     */
    private $botToken = '';

    /**
     * Stores the API URL from Telegram
     * @var string
     */
    private $apiUrl = '';

    /**
     * TelegramLog constructor.
     * @param string $botToken
     */
    public function __construct(string $botToken)
    {
        $this->botToken = $botToken;
        $this->constructApiUrl();
    }

    public function performApiRequest($method)
    {
        $client = new Client();
        $response = $client->post($this->composeApiMethodUrl($method), [
            'form_params' => get_object_vars($method),
        ]);

        $returnObject = 'unreal4u\\Telegram\\Types\\' . $method::objectType();
        $jsonDecoded = json_decode((string)$response->getBody());

        return new $returnObject($jsonDecoded->result);
    }

    /**
     * @return TelegramLog
     */
    final private function constructApiUrl(): TelegramLog
    {
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken;
        return $this;
    }

    /**
     * Builds up the URL with which we can work with
     *
     * @param $call
     * @return string
     */
    private function composeApiMethodUrl($call): string
    {
        return $this->apiUrl . '/' . $call::apiMethod();
    }
}

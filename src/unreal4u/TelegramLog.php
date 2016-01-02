<?php

declare(strict_types = 1);

namespace unreal4u;

use \GuzzleHttp\Client;
use unreal4u\InternalFunctionality\TelegramDocument;
use unreal4u\Telegram\Types\File;

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

    /**
     * Performs the actual telegram request to telegram's servers
     *
     * @param $method
     * @return mixed
     */
    public function performApiRequest($method)
    {
        $client = new Client();
        $response = $client->post($this->composeApiMethodUrl($method), [
            'form_params' => get_object_vars($method),
        ]);

        $returnObject = 'unreal4u\\Telegram\\Types\\' . $method::bindToObjectType();
        $jsonDecoded = json_decode((string)$response->getBody());

        return new $returnObject($jsonDecoded->result);
    }

    /**
     * Will download a file from the Telegram server. Before calling this function, you have to call the getFile method!
     *
     * @see unreal4u\Telegram\Types\File
     * @see unreal4u\Telegram\Methods\GetFile
     *
     * @param File $file
     * @return string
     */
    public function downloadFile(File $file): TelegramDocument
    {
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $client = new Client();
        return new TelegramDocument($client->get($url));
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

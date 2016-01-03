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
        // Things get a bit complicated when we want to send documents or images
        if ($method::requiresMultipartForm() === true) {
            $formData = $this->buildMultipartFormData($method);
        } else {
            // If we have no need to send a multi-part form, save all the hassle and do things the quick way
            $formData = [
                'form_params' => get_object_vars($method),
            ];
        }

        $client = new Client();
        $response = $client->post($this->composeApiMethodUrl($method), $formData);
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

    /**
     * Builds up
     *
     * @param $method
     * @return array
     */
    private function buildMultipartFormData($method): array
    {
        $formData = [
            'multipart' => [],
        ];

        foreach (get_object_vars($method) as $id => $value) {
            // Always send a string unless it's a file
            $fieldValue = (string)$value;
            if (is_string($value) && strpos($value, '@') === 0) {
                $fieldValue = fopen(substr($value, 1), 'r');
            }

            $formData['multipart'][] = [
                'name' => $id,
                'contents' => $fieldValue,
            ];
        }

        return $formData;
    }
}

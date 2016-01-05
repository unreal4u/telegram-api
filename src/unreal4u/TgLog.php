<?php

declare(strict_types = 1);

namespace unreal4u;

use \GuzzleHttp\Client;
use unreal4u\InternalFunctionality\TelegramDocument;
use unreal4u\Telegram\Types\File;

/**
 * The main API which does it all
 */
class TgLog
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

    private $formType = 'application/x-www-form-urlencoded';

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
        $formData = $this->constructFormData($method);

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
     * @return TgLog
     */
    final private function constructApiUrl(): TgLog
    {
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken;
        return $this;
    }

    private function constructFormData($method): array
    {
        foreach ($method as $key => $value) {
            if (is_object($value) && get_class($value) == 'unreal4u\\Telegram\\Types\\Custom\\InputFile') {
                $this->formType = 'multipart/form-data';
                $stream = $value->getStream();
                $id = $key;
            }
        }

        switch ($this->formType) {
            case 'application/x-www-form-urlencoded':
                $formData = [
                    'form_params' => get_object_vars($method),
                ];
                break;
            case 'multipart/form-data':
                $formData = $this->buildMultipartFormData(get_object_vars($method), $id, $stream);
                break;
            default:
                $formData = [];
                break;
        }

        return $formData;
    }

    /**
     * Builds up the URL with which we can work with
     *
     * @param $call
     * @return string
     */
    private function composeApiMethodUrl($call): string
    {
        $completeClassName = get_class($call);
        $methodName = lcfirst(substr($completeClassName, strrpos($completeClassName, '\\') + 1));

        return $this->apiUrl . '/' . $methodName;
    }

    /**
     * Builds up a multipart form-like array for Guzzle
     *
     * @param mixed $method Any supported Telegram method
     * @return array Returns the actual form
     */
    private function buildMultipartFormData(array $data, string $fileKeyName, $stream): array
    {
        $formData = [
            'multipart' => [],
        ];

        foreach ($data as $id => $value) {
            // Always send as a string unless it's a file
            $multiPart = [
                'name' => $id,
                'contents' => null,
            ];

            if ($id === $fileKeyName) {
                $multiPart['contents'] = $stream;
            } else {
                $multiPart['contents'] = (string)$value;
            }

            $formData['multipart'][] = $multiPart;
        }

        return $formData;
    }
}

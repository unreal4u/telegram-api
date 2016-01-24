<?php

declare(strict_types = 1);

namespace unreal4u;

use \GuzzleHttp\Client;
use unreal4u\Abstracts\TelegramTypes;
use unreal4u\InternalFunctionality\TelegramDocument;
use unreal4u\Abstracts\TelegramMethods;
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

    /**
     * With this flag we'll know what type of request to send to Telegram
     *
     * 'application/x-www-form-urlencoded' is the "normal" one, which is simpler and quicker.
     * 'multipart/form-data' should be used only to upload documents, photos, etc.
     *
     * @var string
     */
    private $formType = 'application/x-www-form-urlencoded';

    /**
     * Stores the last method name used
     * @var string
     */
    protected $methodName = '';

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
     * Prepares and sends an API request to Telegram
     *
     * @param TelegramMethods $method
     * @return TelegramTypes
     */
    public function performApiRequest(TelegramMethods $method): TelegramTypes
    {
        $this->resetObjectValues();
        $jsonDecoded = $this->sendRequestToTelegram($method, $this->constructFormData($method));

        $returnObject = 'unreal4u\\Telegram\\Types\\' . $method::bindToObjectType();
        return new $returnObject($jsonDecoded['result']);
    }

    /**
     * Will download a file from the Telegram server. Before calling this function, you have to call the getFile method!
     *
     * @see unreal4u\Telegram\Types\File
     * @see unreal4u\Telegram\Methods\GetFile
     *
     * @param File $file
     * @return TelegramDocument
     */
    public function downloadFile(File $file): TelegramDocument
    {
        $url = $this->apiUrl . $file->file_path;
        $client = new Client();
        return new TelegramDocument($client->get($url));
    }

    /**
     * Builds up the Telegram API url
     * @return TgLog
     */
    final private function constructApiUrl(): TgLog
    {
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken . '/';
        return $this;
    }

    /**
     * This is the method that actually makes the call, which can be easily overwritten so that our unit tests can work
     *
     * @param TelegramMethods $method
     * @param array $formData
     * @return array
     */
    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): array
    {
        $client = new Client();
        $response = $client->post($this->composeApiMethodUrl($method), $formData);
        return json_decode((string)$response->getBody(), true);
    }

    private function resetObjectValues(): TgLog
    {
        $this->formType = 'application/x-www-form-urlencoded';
        $this->methodName = '';

        return $this;
    }

    private function constructFormData(TelegramMethods $method): array
    {
        $result = $this->checkSpecialConditions($method);

        switch ($this->formType) {
            case 'application/x-www-form-urlencoded':
                $formData = [
                    'form_params' => get_object_vars($method),
                ];
                break;
            case 'multipart/form-data':
                $formData = $this->buildMultipartFormData(get_object_vars($method), $result['id'], $result['stream']);
                break;
            default:
                $formData = [];
                break;
        }

        return $formData;
    }

    /**
     * Can perform any special checks needed to be performed before sending the actual request to Telegram
     *
     * This will return an array with data that will be different in each case (for now). This can be changed in the
     * future.
     *
     * @param TelegramMethods $method
     * @return array
     */
    private function checkSpecialConditions(TelegramMethods $method): array
    {
        $method->performSpecialConditions();

        $return = [false];

        foreach ($method as $key => $value) {
            if (is_object($value)) {
                if (get_class($value) == 'unreal4u\\Telegram\\Types\\Custom\\InputFile') {
                    // If we are about to send a file, we must use the multipart/form-data way
                    $this->formType = 'multipart/form-data';
                    $return = [
                        'id' => $key,
                        'stream' => $value->getStream(),
                    ];
                }
            }
        }

        return $return;
    }

    /**
     * Builds up the URL with which we can work with
     *
     * All methods in the Bot API are case-insensitive.
     * All queries must be made using UTF-8.
     *
     * @see https://core.telegram.org/bots/api#making-requests
     *
     * @param TelegramMethods $call
     * @return string
     */
    protected function composeApiMethodUrl(TelegramMethods $call): string
    {
        $completeClassName = get_class($call);
        $this->methodName = substr($completeClassName, strrpos($completeClassName, '\\') + 1);

        return $this->apiUrl . $this->methodName;
    }

    /**
     * Builds up a multipart form-like array for Guzzle
     *
     * @param array $data The original object in array form
     * @param string $fileKeyName A file handler will be sent instead of a string, state here which field it is
     * @param resource $stream The actual file handler
     * @return array Returns the actual formdata to be sent
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

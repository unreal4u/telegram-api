<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramDocument;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\File;
use Psr\Log\LoggerInterface;

/**
 * The main API which does it all
 */
class TgLog
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Stores the token
     * @var string
     */
    private $botToken = '';

    /**
     * Contains an instance to a PSR-3 compatible logger
     * @var LoggerInterface
     */
    protected $logger = null;

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
     * @param LoggerInterface $logger
     */
    public function __construct(string $botToken, LoggerInterface $logger = null)
    {
        $this->botToken = $botToken;

        if (is_null($logger)) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;
        $this->httpClient = new Client();

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
        $this->logger->debug('Going to perform API request, resetting internal class values');
        $this->resetObjectValues();
        $jsonDecoded = $this->sendRequestToTelegram($method, $this->constructFormData($method));

        $returnObject = 'unreal4u\\TelegramAPI\\Telegram\\Types\\' . $method::bindToObjectType();
        $this->logger->debug(sprintf('Decoded response from server, instantiating new %s class', $returnObject));
        return new $returnObject($jsonDecoded['result'], $this->logger);
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
        $this->logger->debug('Downloading file from Telegram, creating URI');
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $this->logger->debug('About to perform request');
        return new TelegramDocument($this->httpClient->get($url));
    }

    /**
     * Builds up the Telegram API url
     * @return TgLog
     */
    final private function constructApiUrl(): TgLog
    {
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken . '/';
        $this->logger->debug('Built up the API URL');
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
        $this->logger->debug('About to instantiate HTTP Client');
        $response = $this->httpClient->post($this->composeApiMethodUrl($method), $formData);
        $this->logger->debug('Got response back from Telegram, applying json_decode');
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
                $this->logger->debug('Creating x-www-form-urlencoded form');
                $formData = [
                    'form_params' => get_object_vars($method),
                ];
                break;
            case 'multipart/form-data':
                $formData = $this->buildMultipartFormData(get_object_vars($method), $result['id'], $result['stream']);
                break;
            default:
                $this->logger->critical('Invalid form-type detected');
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
        $this->logger->debug('Checking special conditions');
        $method->performSpecialConditions();

        $return = [false];

        foreach ($method as $key => $value) {
            if (is_object($value)) {
                if (get_class($value) == 'unreal4u\\TelegramAPI\\Telegram\\Types\\Custom\\InputFile') {
                    $this->logger->debug('About to send a file, so changing request to use multi-part instead');
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
        $this->logger->info('About to perform API request', ['method' => $this->methodName]);

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
        $this->logger->debug('Creating multi-part form array data');
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

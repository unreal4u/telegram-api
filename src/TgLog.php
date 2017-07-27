<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use React\Promise\Deferred;
use React\Promise\PromiseInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\ClientException as CustomClientException;
use unreal4u\TelegramAPI\InternalFunctionality\DummyLogger;
use unreal4u\TelegramAPI\InternalFunctionality\FormConstructor;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramDocument;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UnsuccessfulRequest;
use unreal4u\TelegramAPI\Telegram\Types\File;

/**
 * The main API which does it all
 */
class TgLog
{
    /**
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * @var FormConstructor
     */
    protected $formConstructor;

    /**
     * Stores the token
     * @var string
     */
    private $botToken;

    /**
     * Contains an instance to a PSR-3 compatible logger
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Stores the API URL from Telegram
     * @var string
     */
    private $apiUrl = '';

    /**
     * @var string
     */
    public $methodName = '';

    /**
     * TelegramLog constructor.
     *
     * @param string $botToken
     * @param LoggerInterface $logger
     * @param RequestHandlerInterface $handler
     */
    public function __construct(
        string $botToken,
        LoggerInterface $logger = null,
        RequestHandlerInterface $handler = null
    ) {
        $this->botToken = $botToken;

        // Initialize new dummy logger (PSR-3 compatible) if not injected
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;

        // Initialize new Guzzle client if not injected
        if ($handler === null) {
            $handler = new GuzzleRequestHandler(null, $logger);
        }
        $this->requestHandler = $handler;
        $this->formConstructor = new FormConstructor();

        $this->constructApiUrl();
    }

    /**
     * Prepares and sends an API request to Telegram
     *
     * @param TelegramMethods $method
     * @return TelegramTypes
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function performApiRequest(TelegramMethods $method): TelegramTypes
    {
        $this->logger->debug('Request for API call, resetting internal values', [get_class($method)]);
        $this->resetObjectValues();
        $telegramRawData = $this->sendRequestToTelegram($method, $this->formConstructor->constructFormData($method));
        if ($telegramRawData->isError()) {
            $this->handleOffErrorRequest($telegramRawData);
        }

        return $method::bindToObject($telegramRawData, $this->logger);
    }

    /**
     * @param TelegramMethods $method
     *
     * @return PromiseInterface
     */
    public function performAsyncApiRequest(TelegramMethods $method)
    {
        $this->logger->debug('Request for async API call, resetting internal values', [get_class($method)]);
        $this->resetObjectValues();
        return $this->sendAsyncRequestToTelegram($method, $this->formConstructor->constructFormData($method));
    }

    /**
     * Will download a file from the Telegram server. Before calling this function, you have to call the getFile method!
     *
     * @see \unreal4u\TelegramAPI\Telegram\Types\File
     * @see \unreal4u\TelegramAPI\Telegram\Methods\GetFile
     *
     * @param File $file
     * @return TelegramDocument
     */
    public function downloadFile(File $file): TelegramDocument
    {
        $this->logger->debug('Downloading file from Telegram, creating URL');
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $this->logger->debug('About to perform request to begin downloading file');
        return new TelegramDocument($this->requestHandler->get($url));
    }

    /**
     * @param File $file
     *
     * @return PromiseInterface
     */
    public function downloadFileAsync(File $file): PromiseInterface
    {
        $this->logger->debug('Downloading file async from Telegram, creating URL');
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $this->logger->debug('About to perform request to begin downloading file');

        $deferred = new Deferred();

        return $this->requestHandler->getAsync($url)->then(
            function (ResponseInterface $response) use ($deferred) {
                $deferred->resolve(new TelegramDocument($response));
            },
            function (\Exception $exception) use ($deferred) {
                if (method_exists($exception, 'getResponse') && !empty($exception->getResponse()->getBody())) {
                    $deferred->resolve(new TelegramDocument($exception->getResponse()));
                } else {
                    $deferred->reject($exception);
                }
            }
        );
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
     *
     * @return TelegramRawData
     * @throws \Exception
     */
    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): TelegramRawData
    {
        $e = null;
        $this->logger->debug('About to perform HTTP call to Telegram\'s API');
        try {
            $response = $this->requestHandler->post($this->composeApiMethodUrl($method), $formData);
            $this->logger->debug('Got response back from Telegram');
            return $response;
        } catch (\Exception $e) {
            // It can happen that we have a network problem, in such case, we can't do nothing about it, so rethrow
            if (!method_exists($e, 'getResponse') || empty($e->getResponse())) {
                throw $e;
            }
            return new TelegramRawData((string)$e->getResponse()->getBody(), $e);
        }
    }

    /**
     * @param TelegramMethods $method
     * @param array $formData
     *
     * @return PromiseInterface
     */
    protected function sendAsyncRequestToTelegram(TelegramMethods $method, array $formData): PromiseInterface
    {
        $this->logger->debug('About to perform async HTTP call to Telegram\'s API');
        $deferred = new Deferred();

        $promise = $this->requestHandler->postAsync($this->composeApiMethodUrl($method), $formData);
        $promise->then(
            function (ResponseInterface $response) use ($deferred) {
                $deferred->resolve(new TelegramRawData((string)$response->getBody()));
            },
            function (\Exception $exception) use ($deferred) {
                if (method_exists($exception, 'getResponse') && !empty($exception->getResponse()->getBody())) {
                    $deferred->resolve(new TelegramRawData((string)$exception->getResponse()->getBody(), $exception));
                } else {
                    $deferred->reject($exception);
                }
            }
        );

        return $deferred->promise();
    }

    /**
     * Resets everything to the default values
     *
     * @return TgLog
     */
    private function resetObjectValues(): TgLog
    {
        $this->formConstructor->formType = 'application/x-www-form-urlencoded';
        return $this;
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
     * @param TelegramRawData $telegramRawData
     * @return TgLog
     * @throws CustomClientException
     */
    private function handleOffErrorRequest(TelegramRawData $telegramRawData): TgLog
    {
        $errorRequest = new UnsuccessfulRequest($telegramRawData->getErrorData(), $this->logger);

        $clientException = new CustomClientException(
            $errorRequest->description,
            $errorRequest->error_code,
            $telegramRawData->getException()
        );
        $clientException->setParameters($errorRequest->parameters);
        throw $clientException;
    }
}

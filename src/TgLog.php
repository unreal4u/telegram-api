<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI;

use Psr\Log\LoggerInterface;
use React\Promise\PromiseInterface;
use unreal4u\Dummy\Logger;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\InternalFunctionality\PostOptionsConstructor;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramDocument;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
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
     * @var PostOptionsConstructor
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
    private $apiUrl;

    /**
     * @var string
     */
    protected $methodName = '';

    /**
     * TelegramLog constructor.
     *
     * @param string $botToken
     * @param RequestHandlerInterface $handler
     * @param LoggerInterface $logger
     */
    public function __construct(string $botToken, RequestHandlerInterface $handler, LoggerInterface $logger = null)
    {
        $this->botToken = $botToken;

        // Initialize new dummy logger (PSR-3 compatible) if not injected
        if ($logger === null) {
            $logger = new Logger();
        }
        $this->logger = $logger;

        $this->requestHandler = $handler;
        $this->formConstructor = new PostOptionsConstructor();
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->botToken . '/';
    }

    /**
     * Performs the request to the Telegram servers
     *
     * @param TelegramMethods $method
     *
     * @return PromiseInterface
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function performApiRequest(TelegramMethods $method): PromiseInterface
    {
        $this->logger->debug('Request for async API call, resetting internal values', [\get_class($method)]);
        $this->resetObjectValues();
        $option = $this->formConstructor->constructOptions($method);
        return $this->sendRequestToTelegram($method, $option)
            ->then(function (TelegramResponse $response) use ($method) {
                return $method::bindToObject($response, $this->logger);
            }, function ($error) {
                $this->logger->error($error);
                throw $error;
            });
    }

    /**
     * @param File $file
     *
     * @return PromiseInterface
     */
    public function downloadFile(File $file): PromiseInterface
    {
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $this->logger->debug('About to perform request to begin downloading file');

        return $this->requestHandler->get($url)->then(
            function (TelegramResponse $rawData) {
                return new TelegramDocument($rawData);
            }
        );
    }

    /**
     * This is the method that actually makes the call, which can be easily overwritten so that our unit tests can work
     *
     * @param TelegramMethods $method
     * @param array $formData
     *
     * @return PromiseInterface
     */
    protected function sendRequestToTelegram(TelegramMethods $method, array $formData): PromiseInterface
    {
        $this->logger->debug('About to perform async HTTP call to Telegram\'s API');
        return $this->requestHandler->post($this->composeApiMethodUrl($method), $formData);
    }

    /**
     * Resets everything to the default values
     *
     * @return TgLog
     */
    final protected function resetObjectValues(): TgLog
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
        $completeClassName = \get_class($call);
        $this->methodName = substr($completeClassName, strrpos($completeClassName, '\\') + 1);
        $this->logger->info('About to perform API request', ['method' => $this->methodName]);

        return $this->apiUrl . $this->methodName;
    }
}

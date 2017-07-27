<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class FormConstructor
{
    /**
     * With this flag we'll know what type of request to send to Telegram
     *
     * 'application/x-www-form-urlencoded' is the "normal" one, which is simpler and quicker.
     * 'multipart/form-data' should be used only when you upload documents, photos, etc.
     *
     * @var string
     */
    public $formType = 'application/x-www-form-urlencoded';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;
    }

    /**
     * Builds up the form elements to be sent to Telegram
     *
     * @TODO Move this to apart function
     *
     * @param TelegramMethods $method
     * @return array
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function constructFormData(TelegramMethods $method): array
    {
        $result = $this->checkSpecialConditions($method);

        switch ($this->formType) {
            case 'application/x-www-form-urlencoded':
                $this->logger->debug('Creating x-www-form-urlencoded form (AKA fast request)');
                $formData = [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'body' => http_build_query($method->export(), '', '&'),
                ];
                break;
            case 'multipart/form-data':
                $formData = [
                    'headers' => [
                        'Content-Type' => 'multipart/form-data',
                    ],
                    'body' => $this->buildMultipartFormData($method->export(), $result['id'], $result['stream'])
                ];
                break;
            default:
                $this->logger->critical(sprintf(
                    'Invalid form-type detected, if you incur in such a situation, this is most likely a product to ' .
                    'a bug. Please copy entire line and report at %s',
                    'https://github.com/unreal4u/telegram-api/issues'
                ), [
                    $this->formType
                ]);
                $formData = [
                    'headers' => [
                        'Content-Type' => $this->formType
                    ]
                ];
                break;
        }
        $this->logger->debug('About to send following data', $formData);

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
        $this->logger->debug('Checking whether to apply special conditions to this request');
        $method->performSpecialConditions();

        $return = [false];

        foreach ($method as $key => $value) {
            if (is_object($value) && $value instanceof InputFile) {
                $this->logger->debug('About to send a file, so changing request to use multi-part instead');
                // If we are about to send a file, we must use the multipart/form-data way
                $this->formType = 'multipart/form-data';
                $return = [
                    'id' => $key,
                    'stream' => $value->getStream(),
                ];
            }
        }

        return $return;
    }

    /**
     * Builds up a multipart form-like array for Guzzle
     *
     * @param array $data The original object in array form
     * @param string $fileKeyName A file handler will be sent instead of a string, state here which field it is
     * @param resource $stream The actual file handler
     * @return array Returns the actual formdata to be sent
     */
    public function buildMultipartFormData(array $data, string $fileKeyName, $stream): array
    {
        $this->logger->debug('Creating multi-part form array data (complex and expensive)');

        $multiPartArray = [];
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

            $multiPartArray[] = $multiPart;
        }
        return $multiPartArray;
    }
}

<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use MultipartBuilder\Builder;
use MultipartBuilder\MultipartData;
use Psr\Log\LoggerInterface;
use function strstr;
use unreal4u\Dummy\Logger;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use function pathinfo;
use function stream_get_contents;
use function strlen;
use const PATHINFO_BASENAME;

class PostOptionsConstructor
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
     * This is a flag intended to temporarily store the number of local files
     *
     * @var int
     */
    private $numberOfLocalFiles = 0;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new Logger();
        }
        $this->logger = $logger;
    }

    /**
     * Builds up the form elements to be sent to Telegram
     *
     * @param TelegramMethods $method
     * @return array
     * @throws MissingMandatoryField
     */
    public function constructOptions(TelegramMethods $method): array
    {
        $result = $this->checkIsMultipart($method);

        if (!empty($result)) {
            return $this->constructMultipartOptions(
                $method->export(),
                $result
            );
        }

        $body = http_build_query($method->export(), '', '&');

        return [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Content-Length' => strlen($body),
                'User-Agent' => 'PHP7+ Bot API',
            ],
            'body' => $body
        ];
    }

    /**
     * Check if the given TelegramMethod should be handled as a multipart.
     *
     * @param TelegramMethods $method
     * @return array
     */
    private function checkIsMultipart(TelegramMethods $method): array
    {
        $this->logger->debug('Checking whether to apply special conditions to this request');
        $method->performSpecialConditions();

        $return = [];

        foreach ($method as $key => $value) {
            if ($method->hasLocalFiles() === true) {
                $this->logger->debug('About to send a file, so changing request to use multi-part instead');
                // If we are about to send a file, we must use the multipart/form-data way
                $this->formType = 'multipart/form-data';
                foreach ($method->getLocalFiles() as $identifier => $localFile) {
                    $return[$identifier . '~' . $this->numberOfLocalFiles] = [
                        'id' => $this->numberOfLocalFiles,
                        'filename' => basename($localFile->path),
                        'stream' => $localFile->getStream(),
                    ];
                    $this->numberOfLocalFiles++;
                }
            }
        }

        return $return;
    }

    /**
     * Builds up a multipart form-like array for the HTTP client
     *
     * @param array $data The original object in array form
     * @param array $multipartData
     * @return array Returns the actual formdata to be sent
     */
    public function constructMultipartOptions(array $data, array $multipartData): array
    {
        $builder = $this->constructBodyForMultipart($data, $multipartData);
        $body = $builder->buildAll();
        $completeRequest = [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary="' . $builder->getBoundary() . '"',
                'Content-Length' => strlen($body)
            ],
            'body' => $body
        ];

        return $completeRequest;
    }

    /**
     * Is able to construct the entire body for a multipart form data
     *
     * @param array $data
     * @param array $multipartData
     * @return Builder
     */
    private function constructBodyForMultipart(array $data, array $multipartData): Builder
    {
        $builder = new Builder();
        $this->logger->debug('Creating multi-part form array data (complex and expensive)');

        foreach ($data as $id => $value) {
            if (!$value instanceof InputFile) {
                $appendingData = new MultipartData((string)$id, (string)$value);
                $builder->append($appendingData);
            }
        }

        return $this->appendMediaStream($builder, $multipartData);
    }

    /**
     * Scans the actual media and adds it to the multipart form data
     *
     * @param Builder $builder
     * @param array $multipartData
     * @return Builder
     */
    private function appendMediaStream(Builder $builder, array $multipartData): Builder
    {
        foreach ($multipartData as $identifier => $mediaStream) {
            $appendingData = new MultipartData(
                strstr($identifier, '~', true),
                stream_get_contents($mediaStream['stream']),
                pathinfo($mediaStream['filename'], PATHINFO_BASENAME)
            );

            $builder->append($appendingData);
        }

        return $builder;
    }
}

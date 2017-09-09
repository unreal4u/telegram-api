<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use MultipartBuilder\Builder;
use MultipartBuilder\MultipartData;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

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
    public function constructOptions(TelegramMethods $method): array
    {
        $result = $this->checkIsMultipart($method);

        if (!empty($result)) {
            return $this->constructMultipartOptions(
                $method->export(),
                $result['id'],
                $result['stream'],
                $result['filename']
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
            if (is_object($value) && $value instanceof InputFile) {
                $this->logger->debug('About to send a file, so changing request to use multi-part instead');
                // If we are about to send a file, we must use the multipart/form-data way
                $this->formType = 'multipart/form-data';
                $return = [
                    'id' => $key,
                    'filename' => $value->path,
                    'stream' => $value->getStream()
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
     * @param string $filename
     * @return array Returns the actual formdata to be sent
     */
    public function constructMultipartOptions(array $data, string $fileKeyName, $stream, string $filename): array
    {
        $builder = new Builder();
        $this->logger->debug('Creating multi-part form array data (complex and expensive)');

        foreach ($data as $id => $value) {
            if ($id === $fileKeyName) {
                $data = new MultipartData(
                    (string) $id,
                    stream_get_contents($stream),
                    pathinfo($filename, PATHINFO_BASENAME)
                );
            } else {
                $data = new MultipartData((string) $id, (string) $value);
            }
            
            $builder->append($data);
        }

        $body = $builder->buildAll();
        $array = [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary="' . $builder->getBoundary() . '"',
                'Content-Length' => strlen($body)
            ],
            'body' => $body
        ];
        return $array;
    }
}

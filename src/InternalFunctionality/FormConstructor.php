<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class FormConstructor
{
    /**
     * @var string
     */
    protected $formType = '';

    /**
     * @param TelegramMethods $method
     * @return mixed
     */
    public function constructFormData(TelegramMethods $method): array
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
    public function checkSpecialConditions(TelegramMethods $method): array
    {
        $method->performSpecialConditions();

        $return = [false];

        foreach ($method as $key => $value) {
            if (is_object($value)) {
                if ($value instanceof InputFile) {
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
     * Builds up a multipart form-like array for Guzzle
     *
     * @param array $data The original object in array form
     * @param string $fileKeyName A file handler will be sent instead of a string, state here which field it is
     * @param resource $stream The actual file handler
     * @return array Returns the actual formdata to be sent
     */
    public function buildMultipartFormData(array $data, string $fileKeyName, $stream): array
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

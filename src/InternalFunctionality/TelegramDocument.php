<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use Psr\Http\Message\ResponseInterface;

/**
 * Used when we download a file from Telegram, contains some important headers information that else would be lost
 */
class TelegramDocument
{
    /**
     * The mime type of this file
     * @var string
     */
    public $mime_type = '';

    /**
     * The actual contents of this file
     * @var string
     */
    public $contents = '';

    /**
     * The file size
     * @var int
     */
    public $file_size = 0;

    /**
     * Constructs a representable document
     *
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $headers = $response->getHeaders();
        // What better to get the mime type than what the Telegram servers already send us?
        $this->mime_type = $headers['Content-Type'][0];
        // Same with file length
        $this->file_size = (int)$headers['Content-Length'][0];
        $this->contents = (string)$response->getBody();
    }

    /**
     * When called with string-ish functions, assume we want the actual contents of the file
     * @return string
     */
    public function __toString()
    {
        return $this->contents;
    }
}

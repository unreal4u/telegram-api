<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Exceptions\FileNotReadable;

/**
 * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual
 * way that files are uploaded via the browser.
 *
 * @see https://core.telegram.org/bots/api#inputfile
 */
class InputFile
{
    /**
     * The path of the file
     * @var string
     */
    public $path = '';

    /**
     * The actual stream to the file
     * @var resource
     */
    private $stream;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->setStream();
    }

    /**
     * Will setup the stream
     *
     * @return InputFile
     * @throws FileNotReadable
     */
    private function setStream(): InputFile
    {
        if (is_readable($this->path)) {
            $this->stream = fopen($this->path, 'rb');
        } else {
            throw new FileNotReadable(sprintf('Can not read local file "%s", please check', $this->path));
        }

        return $this;
    }

    public function getStream()
    {
        $this->setStream();
        return $this->stream;
    }
}

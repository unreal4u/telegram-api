<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\Filler;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#document
 */
class Document extends Filler
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Optional. Document thumbnail as defined by sender
     * @var PhotoSize
     */
    public $thumb = null;

    /**
     * Optional. Original filename as defined by sender
     * @var string
     */
    public $file_name = '';

    /**
     * Optional. MIME type of the file as defined by sender
     * @var string
     */
    public $mime_type = '';

    /**
     * Optional. File size
     * @var int
     */
    public $file_size = 0;

    public function __construct(\stdClass $data = null)
    {
        if (!empty($data->thumb)) {
            $data->thumb = new PhotoSize($data->thumb);
        }

        parent::__construct($data);
    }
}

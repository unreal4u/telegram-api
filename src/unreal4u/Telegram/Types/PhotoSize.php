<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\Filler;

/**
 * This object represents one size of a photo or a file / sticker thumbnail
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#photosize
 */
class PhotoSize extends Filler
{
    /**
     * Unique identifier for this file
     * @var string
     */
    public $file_id = '';

    /**
     * Photo width
     * @var int
     */
    public $width = 0;

    /**
     * Photo height
     * @var int
     */
    public $height = 0;

    /**
     * Optional. File size
     * @var int
     */
    public $file_size = 0;

    public function __construct(\stdClass $data = null)
    {
        $this->populateObject($data);
    }
}

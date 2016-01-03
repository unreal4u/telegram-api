<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;

/**
 * This object represents a sticker
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#sticker
 */
class Sticker extends AbstractFiller
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
     * Optional. Sticker thumbnail in .webp or .jpg format
     * @var PhotoSize
     */
    public $thumb = null;

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

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Passport\ElementError;

use unreal4u\TelegramAPI\Telegram\Types\Passport\PassportElementError;

/**
 * This object represents information about an order
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class ReverseSide extends PassportElementError
{
    public $source = 'reverse_side';

    /**
     * Base64-encoded hash of the file with the front side of the document
     * @var string
     */
    public $file_hash = '';
}

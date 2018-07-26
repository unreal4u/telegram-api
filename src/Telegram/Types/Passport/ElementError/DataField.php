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
class DataField extends PassportElementError
{
    public $source = 'data';

    /**
     * Name of the data field which has the error
     * @var string
     */
    public $field_name = '';

    /**
     * Base64-encoded data hash
     * @var string
     */
    public $data_hash = '';
}

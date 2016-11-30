<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Contains information about why a request was unsuccessful
 *
 * NOTE: This is not being used by this API yet as it will introduce BC. It will however be available in v3
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#responseparameters
 */
class ResponseParameters extends TelegramTypes
{
    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is
     * smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this
     * identifier.
     * @var int
     */
    public $migrate_to_chat_id = 0;

    /**
     * Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be
     * repeated
     * @var int
     */
    public $retry_after = 0;
}

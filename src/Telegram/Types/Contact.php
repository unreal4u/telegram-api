<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a phone contact
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#contact
 */
class Contact extends TelegramTypes
{
    /**
     * Contact's phone number
     * @var string
     */
    public $phone_number = '';

    /**
     * Contact's first name
     * @var string
     */
    public $first_name = '';

    /**
     * Optional. Contact's last name
     * @var string
     */
    public $last_name = '';

    /**
     * Optional. Contact's user identifier in Telegram
     * @var int
     */
    public $user_id = 0;
}

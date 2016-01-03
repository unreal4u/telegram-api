<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;

/**
 * This object represents a phone contact
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#contact
 */
class Contact extends AbstractFiller
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

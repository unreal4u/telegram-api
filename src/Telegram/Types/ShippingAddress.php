<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains basic information about an invoice
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#invoice
 */
class ShippingAddress extends TelegramTypes
{
    /**
     * ISO 3166-1 alpha-2 country code
     * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
     * @var string
     */
    public $country_code = '';

    /**
     * State, if applicable
     * @var string
     */
    public $state = '';

    /**
     * City
     * @var string
     */
    public $city = '';

    /**
     * First line for the address
     * @var string
     */
    public $street_line1 = '';

    /**
     * Second line for the address
     * @var string
     */
    public $street_line2 = '';

    /**
     * Address post code
     * @var string
     */
    public $post_code = '';
}

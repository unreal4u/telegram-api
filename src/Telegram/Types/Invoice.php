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
class Invoice extends TelegramTypes
{
    /**
     * Product name
     * @var string
     */
    public $title = '';

    /**
     * Product description
     * @var int
     */
    public $description = '';

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice
     * @var string
     */
    public $start_parameter = '';

    /**
     * Three-letter ISO 4217 currency code
     * @var string
     */
    public $currency = '';

    /**
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of
     * US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the
     * decimal point for each currency (2 for the majority of currencies).
     * @see https://core.telegram.org/bots/payments/currencies.json
     * @var int
     */
    public $total_amount = 0;
}

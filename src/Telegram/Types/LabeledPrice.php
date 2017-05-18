<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a portion of the price for goods or services
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#labeledprice
 */
class LabeledPrice extends TelegramTypes
{
    /**
     * Portion label
     * @var string
     */
    public $label = '';

    /**
     * Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price
     * of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the
     * decimal point for each currency (2 for the majority of currencies).
     * @see https://core.telegram.org/bots/payments/currencies.json
     * @var int
     */
    public $amount = 0;
}

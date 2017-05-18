<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains basic information about a successful payment
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#successfulpayment
 */
class SuccessfulPayment extends TelegramTypes
{
    /**
     * Three-letter ISO 4217 currency code
     * @see https://core.telegram.org/bots/payments#supported-currencies
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

    /**
     * Bot specified invoice payload
     * @var string
     */
    public $invoice_payload = '';

    /**
     * Optional. Identifier of the shipping option chosen by the user
     * @var string
     */
    public $shipping_option_id = '';

    /**
     * Optional. Order info provided by the user
     * @var OrderInfo
     */
    public $order_info;

    /**
     * Telegram payment identifier
     * @var string
     */
    public $telegram_payment_charge_id = '';

    /**
     * Provider payment identifier
     * @var string
     */
    public $provider_payment_charge_id = '';

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'order_info':
                return new OrderInfo($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

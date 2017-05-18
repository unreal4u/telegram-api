<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents information about an order
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class OrderInfo extends TelegramTypes
{
    /**
     * Optional. User name
     * @var string
     */
    public $name = '';

    /**
     * Optional. User's phone number
     * @var string
     */
    public $phone_number = '';

    /**
     * Optional. User email
     * @var string
     */
    public $email = '';

    /**
     * Optional. User shipping address
     * @var ShippingAddress
     */
    public $shipping_address;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'shipping_address':
                return new ShippingAddress($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

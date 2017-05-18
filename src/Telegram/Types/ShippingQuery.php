<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains information about an incoming shipping query
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#shippingquery
 */
class ShippingQuery extends TelegramTypes
{
    /**
     * Unique query identifier
     * @var string
     */
    public $id = '';

    /**
     * User who sent the query
     * @var User
     */
    public $from;

    /**
     * Bot specified invoice payload
     * @var string
     */
    public $invoice_payload = '';

    /**
     * User specified shipping address
     * @var ShippingAddress
     */
    public $shipping_address;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'from':
                return new User($data, $this->logger);
            case 'shipping_address':
                return new ShippingAddress($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

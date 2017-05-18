<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents one shipping option
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#shippingoption
 */
class ShippingOption extends TelegramTypes
{
    /**
     * Shipping option identifier
     * @var string
     */
    public $id = '';

    /**
     * Option title
     * @var string
     */
    public $title = '';

    /**
     * List of price portions
     * @var LabeledPrice[]
     */
    public $prices = [];

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'prices':
                return new LabeledPrice($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

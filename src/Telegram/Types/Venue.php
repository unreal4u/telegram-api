<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a venue
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#venue
 */
class Venue extends TelegramTypes
{
    /**
     * Venue location
     * @var Location
     */
    public $location;

    /**
     * Name of the venue
     * @var string
     */
    public $title = '';

    /**
     * Address of the venue
     * @var string
     */
    public $address = '';

    /**
     * Optional. Foursquare identifier of the venue
     * @var string
     */
    public $foursquare_id = '';

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'location':
                return new Location($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

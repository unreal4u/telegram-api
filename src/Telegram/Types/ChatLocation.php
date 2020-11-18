<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Represents a location to which a chat is connected
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#chat
 */
class ChatLocation extends TelegramTypes
{
    /**
     * The location to which the supergroup is connected. Can't be a live location.
     * @var Location
     */
    public $location;

    /**
     * Location address; 1-64 characters, as defined by the chat owner
     * @var string
     */
    public $address = '';

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'location':
                return new Location($data, $this->logger);
        }
        return parent::mapSubObjects($key, $data);
    }
}

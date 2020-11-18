<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents the content of a service message, sent whenever a user in the chat triggers a proximity alert
 * set by another user
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#proximityalerttriggered
 */
class ProximityAlertTriggered extends TelegramTypes
{
    /**
     * User that triggered the alert
     * @var User
     */
    public $traveler;

    /**
     * User that set the alert
     * @var User
     */
    public $watcher;

    /**
     * The distance between the users
     * @var int
     */
    public $distance;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'traveler':
            case 'watcher':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

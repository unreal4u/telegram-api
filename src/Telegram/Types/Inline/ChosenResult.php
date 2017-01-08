<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\User;
use unreal4u\TelegramAPI\Telegram\Types\Location;

/**
 * This object represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#choseninlineresult
 */
class ChosenResult extends TelegramTypes
{
    /**
     * The unique identifier for the result that was chosen
     * @var string
     */
    public $result_id = '';

    /**
     * The user that chose the result
     * @var User
     */
    public $from;

    /**
     * Optional. Sender location, only for bots that require user location
     * @var Location
     */
    public $location;

    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the
     * message. Will be also received in callback queries and can be used to edit the message.
     * @var string
     */
    public $inline_message_id = '';

    /**
     * The query that was used to obtain the result
     * @var string
     */
    public $query = '';

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'from':
                return new User($data, $this->logger);
            case 'location':
                return new Location($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

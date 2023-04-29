<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Location;
use unreal4u\TelegramAPI\Telegram\Types\User;

/**
 * This object represents an incoming inline query. When the user sends an empty query, your bot could return some
 * default or trending results.
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#inlinequery
 */
class Query extends TelegramTypes
{
    /**
     * Unique identifier for this query
     * @var string
     */
    public $id = '';

    /**
     * User‘s or bot’s first name
     * @var User
     */
    public $from;

    /**
     * Text of the query (up to 512 characters)
     * @var string
     */
    public $query = '';

    /**
     * Offset of the results to be returned, can be controlled by the bot
     * @var string
     */
    public $offset = '';

    /**
     * Optional. Type of the chat from which the inline query was sent. Can be either “sender” for a private chat with
     * the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for
     * requests sent from official clients and most third-party clients, unless the request was sent from a secret chat
     * @var string
     */
    public $chat_type = '';

    /**
     * Optional. Sender location, only for bots that request user location
     * @var Location
     */
    public $location;

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

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that
 * originated the query was attached to a message sent by the bot, the field message will be presented. If the button
 * was attached to a message sent via the bot (in inline mode), the field inline_message_id will be presented.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#callbackquery
 */
class CallbackQuery extends TelegramTypes
{
    /**
     * Unique identifier for this query
     * @var string
     */
    public $id = '';

    /**
     * The user that chose the result
     * @var User
     */
    public $from = null;

    /**
     * Optional. Message with the callback button that originated the query. Note that message content and message date
     * will not be available if the message is too old
     * @var Message
     */
    public $message = null;

    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query
     * @var string
     */
    public $inline_message_id = '';

    /**
     * Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field
     * @var string
     */
    public $data = '';

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'from':
                return new User($data, $this->logger);
            case 'message':
                return new Message($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

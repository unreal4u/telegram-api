<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that
 * originated the query was attached to a message sent by the bot, the field message will be presented. If the button
 * was attached to a message sent via the bot (in inline mode), the field inline_message_id will be presented.
 *
 * NOTE: After the user presses an inline button, Telegram clients will display a progress bar until you call
 * answerCallbackQuery. It is, therefore, necessary to react by calling answerCallbackQuery even if no notification to
 * the user is needed (e.g., without specifying any of the optional parameters).
 *
 * Objects defined as-is January 2017
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
    public $from;

    /**
     * Optional. Message with the callback button that originated the query. Note that message content and message date
     * will not be available if the message is too old
     * @var Message
     */
    public $message;

    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query
     * @var string
     */
    public $inline_message_id = '';

    /**
     * Optional. Global identifier, uniquely corresponding to the chat to which the message with the callback button was
     * sent. Useful for high scores in games
     *
     * @see https://core.telegram.org/bots/api#games
     * @var string
     */
    public $chat_instance = '';

    /**
     * Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this
     * field
     * @var string
     */
    public $data = '';

    /**
     * Optional. Short name of a Game to be returned, serves as the unique identifier for the game
     * @see https://core.telegram.org/bots/api#games
     * @var string
     */
    public $game_short_name = '';

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

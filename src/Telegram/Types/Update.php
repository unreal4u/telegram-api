<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Inline\ChosenResult;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query;

/**
 * This object represents an incoming update.
 * At most one of the optional parameters can be present in any given update.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#update
 */
class Update extends TelegramTypes
{
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase
     * sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated
     * updates or to restore the correct update sequence, should they get out of order. If there are no new updates for
     * at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     * @var int
     */
    public $update_id = 0;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     * @var Message
     */
    public $message;

    /**
     * Optional. New version of a message that is known to the bot and was edited
     * @var Message
     */
    public $edited_message;

    /**
     * Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     * @var Message
     */
    public $channel_post;

    /**
     * Optional. New version of a channel post that is known to the bot and was edited
     * @var Message
     */
    public $edited_channel_post;

    /**
     * Optional. New incoming inline query
     * @var Query
     */
    public $inline_query;

    /**
     * Optional. The result of a inline query that was chosen by a user and sent to their chat partner. Please see our
     * documentation on the feedback collecting for details on how to enable these updates for your bot.
     * @see https://core.telegram.org/bots/inline#collecting-feedback
     * @var ChosenResult
     */
    public $chosen_inline_result;

    /**
     * Optional. New incoming callback query
     * @var CallbackQuery
     */
    public $callback_query;

    /**
     * Optional. New incoming shipping query. Only for invoices with flexible price
     * @var ShippingQuery
     */
    public $shipping_query;

    /**
     * Optional. New incoming pre-checkout query. Contains full information about checkout
     * @var PreCheckoutQuery
     */
    public $pre_checkout_query;

    /**
     * Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     * @var Poll
     */
    public $poll;

    /**
     * Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were
     * sent by the bot itself.
     *
     * @var PollAnswer
     */
    public $poll_answer;

    /**
     * Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only
     * when the bot is blocked or unblocked by the user.
     *
     * @var ChatMemberUpdated
     */
    public $my_chat_member;

    /**
     * Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must
     * explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
     *
     * @var ChatMemberUpdated
     */
    public $chat_member;

    /**
     * Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right
     * in the chat to receive these updates.
     *
     * @var ChatJoinRequest
     */
    public $chat_join_request;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'message':
            case 'edited_message':
            case 'channel_post':
            case 'edited_channel_post':
                return new Message($data, $this->logger);
            case 'inline_query':
                return new Query($data, $this->logger);
            case 'chosen_inline_result':
                return new ChosenResult($data, $this->logger);
            case 'callback_query':
                return new CallbackQuery($data, $this->logger);
            case 'shipping_query':
                return new ShippingQuery($data, $this->logger);
            case 'pre_checkout_query':
                return new PreCheckoutQuery($data, $this->logger);
            case 'poll':
                return new Poll($data, $this->logger);
            case 'poll_answer':
                return new PollAnswer($data, $this->logger);
            case 'my_chat_member':
            case 'chat_member':
                return new ChatMemberUpdated($data, $this->logger);
            case 'chat_join_request':
                return new ChatJoinRequest($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

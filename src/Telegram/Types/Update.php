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
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#update
 */
class Update extends TelegramTypes
{
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase
     * sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated
     * updates or to restore the correct update sequence, should they get out of order.
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
     * Optional. The result of a inline query that was chosen by a user and sent to their chat partner
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
        }

        return parent::mapSubObjects($key, $data);
    }
}

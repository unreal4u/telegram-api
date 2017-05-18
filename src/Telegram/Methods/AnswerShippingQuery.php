<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will
 * send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True
 * is returned.
 *
 * Objects defined as-is May 2017
 *
 * @see https://core.telegram.org/bots/api#answershippingquery
 */
class AnswerShippingQuery extends TelegramMethods
{
    /**
     * Unique identifier for the query to be answered
     * @var string
     */
    public $shipping_query_id = '';

    /**
     * Specify True if delivery to the specified address is possible and False if there are any problems (for example,
     * if delivery to the specified address is not possible)
     * @var bool
     */
    public $ok;

    /**
     * Required if ok is True. A JSON-serialized array of available shipping options
     * @var ShippingOption[]
     */
    public $shipping_options = [];

    /**
     * Required if ok is False. Error message in human readable form that explains why it is impossible to complete the
     * order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the
     * user
     * @var string
     */
    public $error_message = '';

    public function getMandatoryFields(): array
    {
        $return = [
            'shipping_query_id',
            'ok',
        ];

        // Shipping options are mandatory if ok is set to true, otherwise, error_message is
        if ($this->ok === true) {
            $return[] = 'shipping_options';
        } else {
            $return[] = 'error_message';
        }

        return $return;
    }
}

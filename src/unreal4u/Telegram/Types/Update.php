<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;
use unreal4u\Telegram\Types\Message;

/**
 * This object represents an incoming update.
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#update
 */
class Update extends AbstractFiller
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
    public $message = null;

    public function __construct(\stdClass $data = null)
    {
        if (!empty($data->message)) {
            $data->message = new Message($data->message);
        }

        parent::__construct($data);
    }
}

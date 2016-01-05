<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the
 * user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create
 * user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#forcereply
 * @see https://core.telegram.org/bots#privacy-mode
 */
class ForceReply extends AbstractFiller
{
    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'
     * @var bool
     */
    public $force_reply = true;

    /**
     * Optional. Use this parameter if you want to force reply for specific users only. Targets:
     *      1) users that are @mentioned in the text of the Message object;
     *      2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     *
     * @var bool
     */
    public $selective = false;
}

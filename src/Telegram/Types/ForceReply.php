<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the
 * user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create
 * user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#forcereply
 * @see https://core.telegram.org/bots#privacy-mode
 */
class ForceReply extends KeyboardMethods
{
    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'
     * @var bool
     */
    public $force_reply = true;
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a Telegram user or bot.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#user
 */
class User extends TelegramTypes
{
    /**
     * Unique identifier for this user or bot
     * @var int
     */
    public $id = 0;

    /**
     * User‘s or bot’s first name
     * @var string
     */
    public $first_name = '';

    /**
     * Optional. User‘s or bot’s last name
     * @var string
     */
    public $last_name = '';

    /**
     * Optional. User‘s or bot’s username
     * @var string
     */
    public $username = '';

    /**
     * Optional. IETF language tag of the user's language
     * @see https://en.wikipedia.org/wiki/IETF_language_tag
     * @var string
     */
    public $language_code = '';
}

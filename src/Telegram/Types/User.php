<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Methods\GetMe;

/**
 * This object represents a Telegram user or bot.
 *
 * Objects defined as-is June 2020, Bot API v4.9
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
     * True, if this user is a bot
     * @var bool
     */
    public $is_bot = false;

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

    /**
     * Optional. True, if this user is a Telegram Premium user
     * @var bool
     */
    public $is_premium = false;

    /**
     * Optional. True, if the bot can be invited to groups.
     * Returned only in {@see GetMe}.
     * @var bool
     */
    public $can_join_groups;

    /**
     * Optional. True, if privacy mode is disabled for the bot.
     * @see https://core.telegram.org/bots/features#privacy-mode
     * Returned only in {@see GetMe}.
     * @var bool
     */
    public $can_read_all_group_messages;

    /**
     * Optional. True, if the bot supports inline queries.
     * Returned only in {@see GetMe}.
     * @var bool
     */
    public $supports_inline_queries;
}

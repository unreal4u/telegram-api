<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;

/**
 * This object represents a Telegram user or bot.
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#user
 */
class User extends AbstractFiller
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
}

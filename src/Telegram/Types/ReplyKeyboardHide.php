<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;

/**
 * Upon receiving a message with this object, Telegram clients will hide the current custom keyboard and display the
 * default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An
 * exception is made for one-time keyboards that are hidden immediately after the user presses a button (see
 * ReplyKeyboardMarkup).
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#replykeyboardhide
 */
class ReplyKeyboardHide extends KeyboardMethods
{
    /**
     * Requests clients to hide the custom keyboard
     * @var bool
     */
    public $hide_keyboard = true;
}

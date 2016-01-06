<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractKeyboardMethods;

/**
 * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#replykeyboardmarkup
 * @see https://core.telegram.org/bots#keyboards
 */
class ReplyKeyboardMarkup extends AbstractKeyboardMethods
{
    /**
     * Array of button rows, each represented by an Array of Strings
     *
     * Example:
     *
     * $keyboard = [['a', 'b',], ['c', 'd', 'e',], ['f', 'g', ],
     * Will represent three rows displaying a,b in the first, c, d and e in the second and f and g in the third.
     *
     * @var array
     */
    public $keyboard = [];

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if
     * there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same
     * height as the app's standard keyboard.
     * @var bool
     */
    public $resize_keyboard = false;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * @var bool
     */
    public $one_time_keyboard = false;
}

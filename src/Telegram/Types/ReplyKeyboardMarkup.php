<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;

/**
 * This object represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#replykeyboardmarkup
 * @see https://core.telegram.org/bots#keyboards
 */
class ReplyKeyboardMarkup extends KeyboardMethods
{
    /**
     * Array of button rows, each represented by an Array of KeyboardButton objects
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

    public function mapSubObjects(): array
    {
        return [
            'keyboard' => 'Custom\\KeyboardButtonArray',
        ];
    }
}

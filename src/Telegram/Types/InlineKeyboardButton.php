<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields
 *
 * Objects defined as-is April 2016
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
class InlineKeyboardButton
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var array
     */
    public $inline_keyboard = [];

    protected function mapSubObjects(): array
    {
        return [
            'inline_keyboard' => 'InlineKeyboardButton',
        ];
    }
}

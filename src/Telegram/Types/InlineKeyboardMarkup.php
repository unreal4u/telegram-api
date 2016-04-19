<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * Warning: Inline keyboards are currently being tested and are only available in one-on-one chats (i.e., user-bot or
 * user-user in the case of inline bots).
 *
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported
 * message.
 *
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported
 * message.
 *
 * Objects defined as-is April 2016
 *
 * @see https://core.telegram.org/bots/api#replykeyboardhide
 */
class InlineKeyboardMarkup
{
    /**
     * Label text on the button
     * @var string
     */
    public $text = '';

    /**
     * Optional. HTTP url to be opened when button is pressed
     * @var string
     */
    public $url = '';

    /**
     * Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     * @var string
     */
    public $callback_data = '';

    /**
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and
     * insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just the
     * bot’s username will be inserted.
     *
     * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a
     * private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be
     * automatically returned to the chat they switched from, skipping the chat selection screen.
     *
     * @var string
     */
    public $switch_inline_query = '';

    protected function mapSubObjects(): array
    {
        return [
            'inline_keyboard' => 'InlineKeyboardButton',
        ];
    }
}

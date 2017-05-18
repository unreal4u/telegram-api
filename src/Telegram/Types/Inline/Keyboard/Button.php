<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\CallbackGame;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields
 *
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported
 * message.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
class Button extends TelegramTypes
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
     * insert the bot‘s username and the specified inline query in the input field. Can be empty, in which case just
     * the bot’s username will be inserted.
     *
     * Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a
     * private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be
     * automatically returned to the chat they switched from, skipping the chat selection screen.
     *
     * @var string
     */
    public $switch_inline_query = '';

    /**
     * Optional. If set, pressing the button will insert the bot‘s username and the specified inline query in the
     * current chat's input field. Can be empty, in which case only the bot’s username will be inserted.
     *
     * This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting
     * something from multiple options.
     *
     * @var string
     */
    public $switch_inline_query_current_chat = '';

    /**
     * Optional. Description of the game that will be launched when the user presses the button.
     *
     * NOTE: This type of button must always be the first button in the first row.
     *
     * @var CallbackGame
     */
    public $callback_game;

    /**
     * Optional. Specify True, to send a Pay button.
     *
     * NOTE: This type of button must always be the first button in the first row.
     * @var bool
     */
    public $pay = false;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'callback_game':
                return new CallbackGame($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

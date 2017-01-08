<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InlineKeyboardButtonArray;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * Warning: Inline keyboards are currently being tested and are only available in one-on-one chats (i.e., user-bot or
 * user-user in the case of inline bots).
 *
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported
 * message.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#replykeyboardhide
 */
class Markup extends TelegramTypes
{
    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     * @var Button[]
     */
    public $inline_keyboard = [];

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'inline_keyboard':
                return new InlineKeyboardButtonArray($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

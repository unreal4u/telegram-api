<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method to get the number of members in a chat. Returns Int on success
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getchat
 */
class GetChatMembersCount extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    public static function bindToObjectType(): string
    {
        return 'Custom\\ResultInt';
    }
}

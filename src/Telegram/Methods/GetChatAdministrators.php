<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that
 * contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no
 * administrators were appointed, only the creator will be returned.
 *
 * @see https://core.telegram.org/bots/api#getchat
 */
class GetChatAdministrators extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    public static function bindToObjectType(): string
    {
        return 'Custom\\ChatMembersArray';
    }
}

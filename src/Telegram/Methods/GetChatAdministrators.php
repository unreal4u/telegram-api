<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ChatMembersArray;

/**
 * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that
 * contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no
 * administrators were appointed, only the creator will be returned.
 *
 * Objects defined as-is july 2016
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

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ChatMembersArray($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
        ];
    }
}

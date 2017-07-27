<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Use this method to get information about a member of a chat. Returns a ChatMember object on success
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getchatmember
 */
class GetChatMember extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Unique identifier of the target user
     * @var int
     */
    public $user_id = 0;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ChatMember($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'user_id',
        ];
    }
}

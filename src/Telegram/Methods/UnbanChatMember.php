<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group
 * or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work.
 * By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join
 * it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the
 * parameter only_if_banned. Returns True on success.
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#unbanchatmember
 */
class UnbanChatMember extends TelegramMethods
{
    /**
     * Unique identifier for the target group or username of the target supergroup (in the format @supergroupusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Unique identifier of the target user
     * @var int
     */
    public $user_id = 0;

    /**
     * Optional. Do nothing if the user is not banned
     * @var bool
     */
    public $only_if_banned;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'user_id',
        ];
    }
}

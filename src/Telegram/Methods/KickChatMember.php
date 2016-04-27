<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method to kick a user from a group or a supergroup. In the case of supergroups, the user will not be able to 
 * return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in 
 * the group for this to work. Returns True on success.
 * 
 * Note: This will method only work if the ‘All Members Are Admins’ setting is off in the target group. Otherwise 
 * members may only be removed by the group's creator or by the member that added them.
 *
 * @see https://core.telegram.org/bots/api#kickchatmember
 */
class KickChatMember extends TelegramMethods
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

    public static function bindToObjectType(): string
    {
        return 'Custom\\ResultBoolean';
    }
}

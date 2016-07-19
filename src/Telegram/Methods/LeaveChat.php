<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * Use this method for your bot to leave a group, supergroup or channel. Returns True on success
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#kickchatmember
 */
class LeaveChat extends TelegramMethods
{
    /**
     * Unique identifier for the target group or username of the target supergroup (in the format @supergroupusername)
     * @var string
     */
    public $chat_id = '';

    public static function bindToObjectType(): string
    {
        return 'Custom\\ResultBoolean';
    }
}

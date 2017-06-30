<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to kick a user from a group or a supergroup. In the case of supergroups, the user will not be able to
 * return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in
 * the group for this to work. Returns True on success.
 *
 * Note: This will method only work if the ‘All Members Are Admins’ setting is off in the target group. Otherwise
 * members may only be removed by the group's creator or by the member that added them.
 *
 * Objects defined as-is july 2017
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

    /**
     * Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds
     * from the current time they are considered to be banned forever
     * @var int
     */
    public $until_date = 0;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
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

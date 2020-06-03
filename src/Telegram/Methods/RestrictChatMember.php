<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\ChatPermissions;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to
 * work and must have the appropriate admin rights. Pass True for all boolean parameters to lift restrictions from a
 * user. Returns True on success
 *
 * Objects defined as-is June 2020
 *
 * @see https://core.telegram.org/bots/api#restrictchatmember
 */
class RestrictChatMember extends TelegramMethods
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

    /**
     * New user permissions
     * @var ChatPermissions
     */
    public $permissions;

    /**
     * Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or
     * less than 30 seconds from the current time, they are considered to be restricted forever
     * @var int
     */
    public $until_date = 0;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'user_id',
            'permissions',
        ];
    }
}

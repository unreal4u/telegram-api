<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the
 * chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a
 * user. Returns True on success.
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#promotechatmember
 */
class PromoteChatMember extends TelegramMethods
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
     * Pass True, if the administrator can change chat title, photo and other settings
     * @var bool
     */
    public $can_change_info = false;

    /**
     * Pass True, if the administrator can create channel posts, channels only
     * @var bool
     */
    public $can_post_messages = false;

    /**
     * Pass True, if the administrator can edit messages of other users, channels only
     * @var bool
     */
    public $can_edit_messages = false;

    /**
     * Pass True, if the administrator can delete messages of other users
     * @var bool
     */
    public $can_delete_messages = false;

    /**
     * Pass True, if the administrator can invite new users to the chat
     * @var bool
     */
    public $can_invite_users = false;

    /**
     * Pass True, if the administrator can restrict, ban or unban chat members
     * @var bool
     */
    public $can_restrict_members = false;

    /**
     * Pass True, if the administrator can pin messages, supergroups only
     * @var bool
     */
    public $can_pin_messages = false;

    /**
     * Pass True, if the administrator can add new administrators with a subset of his own privileges or demote
     * administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by
     * him)
     * @var bool
     */
    public $can_promote_members = false;


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

<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that has some additional privileges.
 *
 * @see https://core.telegram.org/bots/api#chatmemberadministrator
 */
class ChatMemberAdministrator extends ChatMember
{
    public const STATUS = 'administrator';

    /**
     * The member's status in the chat, always “administrator”
     * @var string
     */
    public $status = self::STATUS;

    /**
     * True, if the bot is allowed to edit administrator privileges of that user
     * @var bool
     */
    public $can_be_edited = false;

    /**
     * True, if the user's presence in the chat is hidden
     * @var bool
     */
    public $is_anonymous = false;

    /**
     * True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see
     * channel members, see anonymous administrators in supergroups and ignore slow mode.
     * Implied by any other administrator privilege
     * @var bool
     */
    public $can_manage_chat = false;

    /**
     * True, if the administrator can delete messages of other users
     * @var bool
     */
    public $can_delete_messages = false;

    /**
     * True, if the administrator can manage video chats
     * @var bool
     */
    public $can_manage_video_chats = false;

    /**
     * @deprecated Use can_manage_video_chats instead (April 16, 2022 Bot API 6.0 https://core.telegram.org/bots/api-changelog#april-16-2022)
     * @var bool
     */
    public $can_manage_voice_chats = false;

    /**
     * True, if the administrator can restrict, ban or unban chat members
     * @var bool
     */
    public $can_restrict_members = false;

    /**
     * True, if the administrator can add new administrators with a subset of their own privileges or demote
     * administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed
     * by the user)
     * @var bool
     */
    public $can_promote_members = false;

    /**
     * True, if the user is allowed to change the chat title, photo and other settings
     * @var bool
     */
    public $can_change_info = false;

    /**
     * True, if the user is allowed to invite new users to the chat
     * @var bool
     */
    public $can_invite_users = false;

    /**
     * Optional. True, if the administrator can post in the channel; channels only
     * @var bool
     */
    public $can_post_messages = false;

    /**
     * Optional. True, if the administrator can edit messages of other users and can pin messages; channels only
     * @var bool
     */
    public $can_edit_messages = false;

    /**
     * Optional. True, if the user is allowed to pin messages; groups and supergroups only
     * @var bool
     */
    public $can_pin_messages = false;

    /**
     * Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     * @var bool
     */
    public $can_manage_topics = false;

    /**
     * Optional. Custom title for this user
     * @var string
     */
    public $custom_title;
}

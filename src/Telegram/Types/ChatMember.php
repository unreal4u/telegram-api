<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object contains information about one member of the chat
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#chatmember
 */
class ChatMember extends TelegramTypes
{
    /**
     * Information about the user
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat. Can be "creator", "administrator", "member", "restricted", "left" or "kicked"
     * @var string
     */
    public $status = '';

    /**
     * Optional. Owner and administrators only. Custom title for this user
     * @var string
     */
    public $custom_title = '';

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user, unix time
     * @var int
     */
    public $until_date = 0;

    /**
     * Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user
     * @var bool
     */
    public $can_be_edited = false;

    /**
     * Optional. Administrators only. True, if the administrator can post in the channel, channels only
     * @var bool
     */
    public $can_post_messages = false;

    /**
     * Optional. Administrators only. True, if the administrator can edit messages of other users, channels only
     * @var bool
     */
    public $can_edit_messages = false;

    /**
     * Optional. Administrators only. True, if the administrator can delete messages of other users
     * @var bool
     */
    public $can_delete_messages = false;

    /**
     * Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members
     * @var bool
     */
    public $can_restrict_members = false;

    /**
     * Optional. Administrators only. True, if the administrator can add new administrators with a subset of his own
     * privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators
     * that were appointed by the user)
     * @var bool
     */
    public $can_promote_members = false;

    /**
     * Optional. Administrators only. True, if the administrator can change the chat title, photo and other settings
     * @var bool
     */
    public $can_change_info = false;

    /**
     * Optional. Administrators only. True, if the administrator can invite new users to the chat
     * @var bool
     */
    public $can_invite_users = false;

    /**
     * Optional. Administrators only. True, if the administrator can pin messages, supergroups only
     * @var bool
     */
    public $can_pin_messages = false;

    /**
     * Optional. Restricted only. True, if the user is a member of the chat at the moment of the request
     * @var bool
     */
    public $is_member = false;

    /**
     * Optional. Restricted only. True, if the user can send text messages, contacts, locations and venues
     * @var bool
     */
    public $can_send_messages = false;

    /**
     * Optional. Restricted only. True, if the user can send audios, documents, photos, videos, video notes and voice
     * notes, implies can_send_messages
     * @var bool
     */
    public $can_send_media_messages = false;

    /**
     * Optional. Restricted only. True, if the user is allowed to send polls
     * @var bool
     */
    public $can_send_polls = false;

    /**
     * Optional. Restricted only. True, if the user can send animations, games, stickers and use inline bots, implies
     * can_send_media_messages
     * @var bool
     */
    public $can_send_other_messages = false;

    /**
     * Optional. Restricted only. True, if user may add web page previews to his messages, implies
     * can_send_media_messages
     * @var bool
     */
    public $can_add_web_page_previews = false;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

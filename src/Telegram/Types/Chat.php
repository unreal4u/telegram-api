<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a chat.
 *
 * Objects defined as-is november 2020, Bot API v5.0
 *
 * @see https://core.telegram.org/bots/api#chat
 */
class Chat extends TelegramTypes
{
    /**
     * Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have
     * difficulty/silent defects in interpreting it. But it smaller than 52 bits, so a signed 64 bit integer or
     * double-precision float type are safe for storing this identifier
     * @var int
     */
    public $id = 0;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var string
     */
    public $type = '';

    /**
     * Optional. Title, for channels and group chats
     * @var string
     */
    public $title = '';

    /**
     * Optional. Username, for private chats, supergroups and channels if available
     * @var string
     */
    public $username = '';

    /**
     * Optional. First name of the other party in a private chat
     * @var string
     */
    public $first_name = '';

    /**
     * Optional. Last name of the other party in a private chat
     * @var string
     */
    public $last_name = '';

	/**
	 * Optional. True, if the supergroup chat is a forum (has topics enabled)
	 */
	public $is_forum = false;

    /**
     * Optional. Chat photo.
     * Returned only in {@see getChat}.
     * @var ChatPhoto
     */
    public $photo;

    /**
     * Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels.
     * Returned only in {@see getChat}
     * @var array<string>
     */
    public $active_usernames = [];

    /**
     * Optional. Custom emoji identifier of emoji status of the other party in a private chat.
     * Returned only in {@see getChat}.
     * @var string
     */
    public $emoji_status_custom_emoji_id;

    /**
     * Optional. Bio of the other party in a private chat.
     * Returned only in {@see getChat}.
     * @var string
     */
    public $bio;

    /**
     * Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id>
     * links only in chats with the user.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $has_private_forwards;

    /**
     * Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the
     * private chat.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $has_restricted_voice_and_video_messages;

    /**
     * Optional. True, if users need to join the supergroup before they can send messages.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $join_to_send_messages;

    /**
     * Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $join_by_request;

    /**
     * Optional. Description, for groups, supergroups and channel chats.
     * Returned only in {@see getChat}.
     * @var string
     */
    public $description = '';

    /**
     * Optional. Chat invite link, for supergroups and channel chats.
     * Returned only in {@see getChat}.
     * @var string
     */
    public $invite_link = '';

    /**
     * Optional. Pinned message, for supergroups.
     * Returned only in {@see getChat}.
     * @var Message
     */
    public $pinned_message;

    /**
     * Optional. Default chat member permissions, for groups and supergroups.
     * Returned only in {@see getChat}.
     *
     * @var ChatPermissions
     */
    public $permissions;

    /**
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user.
     * Returned only in {@see getChat}.
     *
     * @var int
     */
    public $slow_mode_delay;

    /**
     * Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds.
     * Returned only in {@see getChat}.
     *
     * @var int
     */
    public $message_auto_delete_time;

    /**
     * Optional. True, if aggressive anti-spam checks are enabled in the supergroup. The field is only available to
     * chat administrators.
     * Returned only in {@see getChat}.
     *
     * @var true
     */
    public $has_aggressive_anti_spam_enabled;

    /**
     * Optional. True, if non-administrators can only get the list of bots and administrators in the chat.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $has_hidden_members;

    /**
     * Optional. True, if messages from the chat can't be forwarded to other chats.
     * Returned only in {@see getChat}.
     * @var true
     */
    public $has_protected_content;

    /**
     * Optional. For supergroups, name of Group sticker set.
     * Returned only in {@see getChat}.
     * @var string
     */
    public $sticker_set_name = '';

    /**
     * Optional. True, if the bot can change group the sticker set.
     * Returned only in {@see getChat}.
     * @var bool
     */
    public $can_set_sticker_set = false;

    /**
     * Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice
     * versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming
     * languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64
     * bit integer or double-precision float type are safe for storing this identifier.
     * Returned only in {@see getChat}.
     * @var int
     */
    public $linked_chat_id = 0;

    /**
     * Optional. For supergroups, the location to which the supergroup is connected.
     * Returned only in {@see getChat}.
     * @var ChatLocation
     */
    public $location;


    /**
     * @deprecated Bot API 4.4 (July 29, 2019)
     *  The field all_members_are_administrators has been removed from the documentation for the Chat object.
     *  The field is still returned in the object for backward compatibility, but new bots should use the permissions
     *  field instead.
     *
     * @var bool
     */
    public $all_members_are_administrators;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'photo':
                return new ChatPhoto($data, $this->logger);
            case 'pinned_message':
                return new Message($data, $this->logger);
            case 'permissions':
                return new ChatPermissions($data, $this->logger);
            case 'location':
                return new ChatLocation($data, $this->logger);
        }
        return parent::mapSubObjects($key, $data);
    }
}

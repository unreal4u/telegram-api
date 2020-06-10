<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a chat.
 *
 * Objects defined as-is June 2020, Bot API v4.9
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
     * Optional. Chat photo. Returned only in getChat
     * @var ChatPhoto
     */
    public $photo;

    /**
     * Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     * @var string
     */
    public $description = '';

    /**
     * Optional. Chat invite link, for supergroups and channel chats. Returned only in getChat
     * @var string
     */
    public $invite_link = '';

    /**
     * Optional. Pinned message, for supergroups. Returned only in getChat
     * @var Message
     */
    public $pinned_message;

    /**
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var ChatPermissions
     */
    public $permissions;

    /**
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged
     * user. Returned only in getChat
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var int
     */
    public $slow_mode_delay;

    /**
     * Optional. For supergroups, name of Group sticker set. Returned only in getChat
     * @var string
     */
    public $sticker_set_name = '';

    /**
     * Optional. True, if the bot can change group the sticker set. Returned only in getChat
     * @var bool
     */
    public $can_set_sticker_set = false;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'photo':
                return new ChatPhoto($data, $this->logger);
            case 'pinned_message':
                return new Message($data, $this->logger);
            case 'permissions':
                return new ChatPermissions($data, $this->logger);
        }
        return parent::mapSubObjects($key, $data);
    }
}

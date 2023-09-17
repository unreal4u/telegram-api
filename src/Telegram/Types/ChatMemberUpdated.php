<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents changes in the status of a chat member.
 *
 * @see https://core.telegram.org/bots/api#chatmemberupdated
 */
class ChatMemberUpdated extends TelegramTypes
{
    /**
     * Chat the user belongs to
     * @var Chat
     */
    public $chat;

    /**
     * Performer of the action, which resulted in the change
     * @var User
     */
    public $from;

    /**
     * Date the change was done in Unix time
     * @var int
     */
    public $date;

    /**
     * Previous information about the chat member
     * @var ChatMember
     */
    public $old_chat_member;

    /**
     * New information about the chat member
     * @var ChatMember
     */
    public $new_chat_member;

    /**
     * Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     * @var ChatInviteLink
     */
    public $invite_link;

    /**
     * Optional. True, if the user joined the chat via a chat folder invite link
     * @var bool
     */
    public $via_chat_folder_invite_link;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'chat':
                return new Chat($data, $this->logger);
            case 'from':
                return new User($data, $this->logger);
            case 'old_chat_member':
            case 'new_chat_member':
                return new ChatMember($data, $this->logger);
            case 'invite_link':
                return new ChatInviteLink($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

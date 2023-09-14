<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that has some additional privileges.
 *
 * @see https://core.telegram.org/bots/api#chatmemberowner
 */
class ChatMemberOwner extends ChatMember
{
    public const STATUS = 'creator';

    /**
     * The member's status in the chat, always “creator”
     * @var string
     */
    public $status = self::STATUS;

    /**
     * True, if the user's presence in the chat is hidden
     * @var bool
     */
    public $is_anonymous = false;

    /**
     * Optional. Custom title for this user
     * @var string
     */
    public $custom_title;
}

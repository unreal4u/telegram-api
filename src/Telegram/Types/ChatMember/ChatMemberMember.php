<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that has no additional privileges or restrictions.
 *
 * @see https://core.telegram.org/bots/api#chatmembermember
 */
class ChatMemberMember extends ChatMember
{
    public const STATUS = 'member';

    /**
     * The member's status in the chat, always “member”
     * @var string
     */
    public $status = self::STATUS;
}

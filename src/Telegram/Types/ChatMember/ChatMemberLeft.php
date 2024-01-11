<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 *
 * @see https://core.telegram.org/bots/api#chatmemberleft
 */
class ChatMemberLeft extends ChatMember
{
    public const STATUS = 'left';

    /**
     * The member's status in the chat, always “left”
     * @var string
     */
    public $status = self::STATUS;
}

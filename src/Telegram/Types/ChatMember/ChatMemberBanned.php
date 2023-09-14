<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that was banned in the chat and can't return to the chat or view chat messages.
 *
 * @see https://core.telegram.org/bots/api#chatmemberbanned
 */
class ChatMemberBanned extends ChatMember
{
    public const STATUS = 'kicked';

    /**
     * The member's status in the chat, always “kicked”
     * @var string
     */
    public $status = self::STATUS;

    /**
     * Date when restrictions will be lifted for this user; Unix time. If 0, then the user is banned forever
     * @var int
     */
    public $until_date = 0;
}

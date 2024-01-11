<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberAdministrator;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberBanned;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberLeft;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberMember;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberOwner;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember\ChatMemberRestricted;

/**
 * This object contains information about one member of the chat
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#chatmember
 */
class ChatMember extends TelegramTypes
{
    private const CHILD_CLASS_REFERENCES = [
        ChatMemberOwner::class,
        ChatMemberAdministrator::class,
        ChatMemberMember::class,
        ChatMemberRestricted::class,
        ChatMemberLeft::class,
        ChatMemberBanned::class,
    ];

    /**
     * Information about the user
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat. See childs of this class or API documentation for possible values.
     * @var string
     */
    public $status = '';

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }

    /**
     * Create specific ChatMember class based on 'status'. If there is no match,
     */
    public static function create(array $data, LoggerInterface $logger): ChatMember
    {
        $status = $data['status'] ?? null;

        foreach (self::CHILD_CLASS_REFERENCES as $childClassReference) {
            if ($status === $childClassReference::STATUS) {
                return new $childClassReference($data, $logger);
            }
        }
        $logger->error(sprintf(
            'Unable to detect correct "%s" class based on status = "%s"! Maybe a recent Telegram Bot ' .
            'API update? In any way, please submit an issue (bug report) at %s with this complete log line',
            self::class,
            $status ?? 'null',
            'https://github.com/unreal4u/telegram-api/issues'
        ), [
            'object' => self::class,
            'data' => $data,
        ]);

        return new ChatMember($data, $logger);
    }
}

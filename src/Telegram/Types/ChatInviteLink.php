<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Represents an invite link for a chat.
 *
 * @see https://core.telegram.org/bots/api#chatinvitelink
 */
class ChatInviteLink extends TelegramTypes
{
    /**
     * The invite link. If the link was created by another chat administrator, then the second part of the link will be
     * replaced with “…”.
     * @var string
     */
    public $invite_link;

    /**
     * Creator of the link
     * @var User
     */
    public $creator;

    /**
     * True, if users joining the chat via the link need to be approved by chat administrators
     * @var bool
     */
    public $creates_join_request = false;

    /**
     * True, if the link is primary
     * @var bool
     */
    public $is_primary = false;

    /**
     * True, if the link is revoked
     * @var bool
     */
    public $is_revoked = false;

    /**
     * Optional. Invite link name
     * @var string
     */
    public $name;

    /**
     * Optional. Point in time (Unix timestamp) when the link will expire or has been expired
     * @var int
     */
    public $expire_date;

    /**
     * Optional. The maximum number of users that can be members of the chat simultaneously after joining the chat via
     * this invite link; 1-99999
     * @var int
     */
    public $member_limit;

    /**
     * Optional. Number of pending join requests created using this link
     * @var int
     */
    public $pending_join_request_count;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'creator':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

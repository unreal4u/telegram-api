<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Represents a join request sent to a chat.
 *
 * @see https://core.telegram.org/bots/api#chatjoinrequest
 */
class ChatJoinRequest extends TelegramTypes
{
    /**
     * Chat to which the request was sent
     *
     * @var Chat
     */
    public $chat;

    /**
     * User that sent the join request
     *
     * @var User
     */
    public $from;

    /**
     * Identifier of a private chat with the user who sent the join request. The bot can use this identifier
     * for 24 hours to send messages until the join request is processed, assuming no other administrator contacted
     * the user.
     *
     * @var int
     */
    public $user_chat_id;

    /**
     * Date the request was sent in Unix time
     *
     * @var int
     */
    public $date;

    /**
     * Optional. Bio of the user.
     *
     * @var string
     */
    public $bio;

    /**
     * Optional. Chat invite link that was used by the user to send the join request
     *
     * @var ChatInviteLink
     */
    public $invite_link;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'chat':
                return new Chat($data, $this->logger);
            case 'from':
                return new User($data, $this->logger);
            case 'invite_link':
                return new ChatInviteLink($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

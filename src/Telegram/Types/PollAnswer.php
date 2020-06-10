<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#pollanswer
 */
class PollAnswer extends TelegramTypes
{
    /**
     * Unique poll identifier
     * @var string
     */
    public $poll_id;

    /**
     * The user, who changed the answer to the poll
     * @var User
     */
    public $user;

    /**
     * 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     * @var int[]
     */
    public $option_ids = [];

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }
        return parent::mapSubObjects($key, $data);
    }
}

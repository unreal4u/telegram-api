<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PollOptionArray;

/**
 * This object contains information about a poll
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#poll
 */
class Poll extends TelegramTypes
{
    /**
     * Unique poll identifier
     * @var string
     */
    public $id;

    /**
     * Poll question, 1-255 characters
     * @var string
     */
    public $question = '';

    /**
     * List of poll options
     * @var PollOption[]
     */
    public $options;

    /**
     * Total number of users that voted in the poll
     * @var int
     */
    public $total_voter_count;

    /**
     * True, if the poll is closed
     * @var bool
     */
    public $is_closed;

    /**
     * True, if the poll is anonymous
     * @var bool
     */
    public $is_anonymous;

    /**
     * Poll type, currently can be “regular” or “quiz”
     * @var string
     */
    public $type;

    /**
     * True, if the poll allows multiple answers
     * @var bool
     */
    public $allow_multiple_answers;

    /**
     * Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are
     * closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     *
     * @var int
     */
    public $correct_option_id;

    /**
     * Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style
     * poll, 0-200 characters
     *
     * @var string
     */
    public $explanation;

    /**
     * Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
     * @var MessageEntityArray
     */
    public $explanation_entities;

    /**
     * Optional. Amount of time in seconds the poll will be active after creation
     * @var int
     */
    public $open_period;

    /**
     * Optional. Point in time (Unix timestamp) when the poll will be automatically closed
     * @var int
     */
    public $close_date;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'options':
                return new PollOptionArray($data, $this->logger);
            case 'explanation_entities':
                return new MessageEntityArray($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

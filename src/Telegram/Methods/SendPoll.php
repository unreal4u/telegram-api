<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\KeyboardMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use function json_encode;

/**
 * Use this method to send point on the map. On success, the sent Message is returned.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#sendpoll
 */
class SendPoll extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername). A
     * native poll can't be sent to a private chat
     * @var string
     */
    public $chat_id = '';

    /**
     * Poll question, 1-255 characters
     * @var string
     */
    public $question = '';

    /**
     * List of answer options, 2-10 strings 1-100 characters each
     * @var string[]
     */
    public $options = [];

    /**
     * Optional. True, if the poll needs to be anonymous, defaults to True
     * @var bool
     */
    public $is_anonymous = true;

    /**
     * Optional. Poll type, “quiz” or “regular”, defaults to “regular”
     * @var string
     */
    public $type = 'regular';

    /**
     * Optional. True, if the poll allows multiple answers, ignored for polls in quiz mode, defaults to False
     * @var bool
     */
    public $allows_multiple_answers = false;

    /**
     * Optional. 0-based identifier of the correct answer option, required for polls in quiz mode
     * @var int
     */
    public $correct_option_id = -1;

    /**
     * Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style
     * poll, 0-200 characters with at most 2 line feeds after entities parsing
     *
     * @var string
     */
    public $explanation = '';

    /**
     * Optional. Mode for parsing entities in the explanation. See formatting options for more details
     * @see https://core.telegram.org/bots/api#formatting-options
     *
     * @var string
     */
    public $explanation_parse_mode = '';

    /**
     * Optional. Amount of time in seconds the poll will be active after creation, 5-600. Can't be used together with
     * close_date.
     *
     * @var int
     */
    public $open_period = -1;

    /**
     * Optional. Point in time (Unix timestamp) when the poll will be automatically closed. Must be at least 5 and no
     * more than 600 seconds in the future. Can't be used together with open_period
     *
     * @var int
     */
    public $close_date = -1;

    /**
     * Optional. Pass True, if the poll needs to be immediately closed. This can be useful for poll preview.
     * @var bool
     */
    public $is_closed = false;

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to
     * hide keyboard or to force a reply from the user.
     * @var KeyboardMethods
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'question',
            'options',
        ];
    }

    public function performSpecialConditions(): TelegramMethods
    {
        $this->options = json_encode($this->options);
        return parent::performSpecialConditions();
    }
}

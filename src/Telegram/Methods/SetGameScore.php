<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\InvalidResultType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to set the score of the specified user in a game. On success, if the message was sent by the bot,
 * returns the edited Message, otherwise returns True. Returns an error, if the new score is not greater than the user's
 * current score in the chat and force is False
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#setgamescore
 */
class SetGameScore extends TelegramMethods
{
    /**
     * User identifier
     * @var int
     */
    public $user_id = 0;

    /**
     * New score, must be non-negative
     * @var int
     */
    public $score = 0;

    /**
     * Pass True, if the high score is allowed to decrease. This can be useful when fixing mistakes or banning cheaters
     * @var boolean
     */
    public $force = false;

    /**
     * Pass True, if the game message should not be automatically edited to include the current scoreboard
     * @var boolean
     */
    public $disable_edit_message = false;

    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat
     * @var int
     */
    public $chat_id;

    /**
     * Required if inline_message_id is not specified. Identifier of the sent message
     * @var int
     */
    public $message_id;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        $typeOfResult = $data->getTypeOfResult();
        switch ($typeOfResult) {
            case 'array':
                return new Message($data->getResult(), $logger);
            case 'boolean':
                return new ResultBoolean($data->getResultBoolean(), $logger);
            default:
                throw new InvalidResultType('Result is of type: %s. Expecting one of array or boolean');
        }
    }

    public function getMandatoryFields(): array
    {
        // user_id and score are always mandatory
        $returnValue[] = 'user_id';
        $returnValue[] = 'score';
        return $this->mandatoryUserOrInlineMessageId($returnValue);
    }
}

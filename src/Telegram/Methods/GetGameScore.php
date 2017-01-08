<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\GameHighScoreArray;

/**
 * Use this method to get data for high score tables. Will return the score of the specified user and several of his
 * neighbors in a game. On success, returns an Array of GameHighScore objects.
 *
 * This method will currently return scores for the target user, plus two of his closest neighbors on each side. Will
 * also return the top three users if the user and his neighbors are not among them. Please note that this behavior is
 * subject to change.
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#getgamescore
 */
class GetGameScore extends TelegramMethods
{
    /**
     * Target user id
     * @var int
     */
    public $user_id = 0;

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

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new GameHighScoreArray($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        // user_id and score are always mandatory
        $returnValue[] = 'user_id';
        return $this->mandatoryUserOrInlineMessageId($returnValue);
    }
}

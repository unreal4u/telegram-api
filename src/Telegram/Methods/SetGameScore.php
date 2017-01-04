<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\InvalidResultType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update
 * for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of
 * an unsuccessful request, we will give up after a reasonable amount of attempts. Returns true.
 *
 * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL,
 * e.g. https://www.example.com/<token>. Since nobody else knows your bot‘s token, you can be pretty sure it’s us.
 *
 * Notes
 * <ul>
 *  <li>You will not be able to receive updates using getUpdates for as long as an outgoing webhook is set up.</li>
 *  <li>To use a self-signed certificate, you need to upload your public key certificate using certificate parameter.
 *      Please upload as InputFile, sending a String will not work.</li>
 *  <li>Ports currently supported for Webhooks: 443, 80, 88, 8443.</li>
 * </ul>
 *
 * Objects defined as-is December 2016
 *
 * @see https://core.telegram.org/bots/api#setwebhook
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

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
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

        if (empty($this->chat_id) && empty($this->message_id)) {
            $returnValue[] = 'inline_message_id';
        }

        // On the other hand, chat_id and message_id are mandatory if inline_message_id is not filled in
        if (empty($this->inline_message_id)) {
            $returnValue[] = 'chat_id';
            $returnValue[] = 'message_id';
        }

        return $returnValue;
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\InvalidResultType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be
 * edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On
 * success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned
 *
 * Objects defined as-is october 2017
 *
 * @see https://core.telegram.org/bots/api#editmessagelivelocation
 */
class EditMessageLiveLocation extends TelegramMethods
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Required if inline_message_id is not specified. Unique identifier of the sent message
     * @var int
     */
    public $message_id = 0;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string
     */
    public $inline_message_id = '';

    /**
     * Latitude of new location
     * @var float
     */
    public $latitude = 0.0;

    /**
     * Longitude of new location
     * @var float
     */
    public $longitude = 0.0;

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue = [
            'longitude',
            'latitude',
        ];
        return $this->mandatoryUserOrInlineMessageId($returnValue);
    }

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
}

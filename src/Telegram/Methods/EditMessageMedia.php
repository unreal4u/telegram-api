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
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Use this method to edit audio, document, photo, or video messages. If a message is a part of a message album, then it
 * can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is
 * edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the
 * edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 *
 * Objects defined as-is july 2018
 *
 * @see https://core.telegram.org/bots/api#editmessagemedia
 */
class EditMessageMedia extends TelegramMethods
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
     * A JSON-serialized object for a new media content of the message
     * @var InputMedia
     */
    public $media;

    /**
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup;

    public function getMandatoryFields(): array
    {
        $returnValue[] = 'media';
        $this->mandatoryUserOrInlineMessageId($returnValue);
        return $returnValue;
    }

    /**
     * @param TelegramRawData $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     * @throws InvalidResultType
     */
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        $typeOfResult = $data->getTypeOfResult();
        switch ($typeOfResult) {
            case 'array':
                return new Message($data->getResult(), $logger);
            case 'boolean':
                return new ResultBoolean($data->getResultBoolean(), $logger);
            default:
                throw new InvalidResultType(sprintf(
                    'Result is of type: %s. Expecting one of array or boolean',
                    $typeOfResult
                ));
        }
    }
}

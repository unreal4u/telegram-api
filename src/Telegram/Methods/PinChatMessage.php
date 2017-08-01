<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to pin a message in a supergroup. The bot must be an administrator in the chat for this to work and
 * must have the appropriate admin rights. Returns True on success
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#pinchatmessage
 */
class PinChatMessage extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * @var string
     */
    public $chat_id = '';

    /**
     * Identifier of a message to pin
     * @var int
     */
    public $message_id = 0;

    /**
     * Optional. Pass True, if it is not necessary to send a notification to all group members about the new pinned
     * message
     * @var bool
     */
    public $disable_notification = false;

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'message_id',
        ];
    }
}

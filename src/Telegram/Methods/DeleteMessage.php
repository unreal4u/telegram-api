<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to delete a message. A message can only be deleted if it was sent less than 48 hours ago. Any such
 * recently sent outgoing message may be deleted. Additionally, if the bot is an administrator in a group chat, it can
 * delete any message. If the bot is an administrator in a supergroup, it can delete messages from any other user and
 * service messages about people joining or leaving the group (other types of service messages may only be removed by
 * the group creator). In channels, bots can only remove their own messages. Returns True on success
 *
 * Objects defined as-is May 2017
 *
 * @see GetUpdates
 * @see https://core.telegram.org/bots/api#deletemessage
 */
class DeleteMessage extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Identifier of the message to delete
     * @var int
     */
    public $message_id = 0;

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
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

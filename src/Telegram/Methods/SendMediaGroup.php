<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageArray;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;

/**
 * Use this method to send photos. On success, the sent Message is returned
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#sendphoto
 */
class SendMediaGroup extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * A JSON-serialized array describing photos and videos to be sent
     * @var InputMedia[]
     */
    public $media = [];

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * Optional. If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'media',
        ];
    }
    
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new MessageArray($data, $logger);
    }
}

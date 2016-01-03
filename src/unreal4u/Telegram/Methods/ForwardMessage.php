<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * Object that resembles a message object in Telegram
 *
 * @see https://core.telegram.org/bots/api#forwardmessage
 */
class ForwardMessage extends AbstractMethodFunctions
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Unique identifier for the chat where the original message was sent (or channel username in the
     * format @channelusername)
     * @var string
     */
    public $from_chat_id = '';

    /**
     * Unique message identifier
     * @var int
     */
    public $message_id = 0;

    public static function apiMethod(): string
    {
        return 'forwardMessage';
    }
}

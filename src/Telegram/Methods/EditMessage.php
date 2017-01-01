<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;

abstract class EditMessage extends TelegramMethods
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
     * Optional. A JSON-serialized object for an inline keyboard.
     * @var Markup
     */
    public $reply_markup = null;

    public function getMandatoryFields(): array
    {
        $returnValue = [];
        // Inline_message_id is mandatory if no chat_id and message_id are filled in
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

    public function getMethodName(): string
    {
        $completeClassName = get_class($this);
        return 'editMessage'.substr($completeClassName, strrpos($completeClassName, '\\') + 1);
    }
}

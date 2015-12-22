<?php

declare(strict_types = 1);

namespace unreal4u\Telegram;

/**
 * Object that resembles a message object in Telegram
 *
 * Will be filled in in the near future
 *
 * @see https://core.telegram.org/bots/api#message
 * @package unreal4u\Telegram
 */
class Message
{
    public $chatId = '';
    public $text = '';

    public function __construct(array $message = [])
    {
        if (!empty($message)) {
            $this->chatId = $message['chatId'];
            $this->text = $message['text'];
        }
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

abstract class KeyboardMethods extends TelegramTypes
{
    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only. Targets:
     *      1) users that are @mentioned in the text of the Message object;
     *      2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     *
     * Example 1: A user requests to change the bot‘s language, bot replies to the request with a keyboard to select
     * the new language. Other users in the group don’t see the keyboard.
     *
     * Example 2: A user votes in a poll, bot returns confirmation message in reply to the vote and hides keyboard for
     * that user, while still showing the keyboard with poll options to users who haven't voted yet.
     *
     * @var bool
     */
    public $selective = false;
}

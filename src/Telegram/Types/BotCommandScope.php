<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents the scope to which bot commands are applied. Currently, the following 7 scopes are supported:
 * BotCommandScopeDefault
 * BotCommandScopeAllPrivateChats
 * BotCommandScopeAllGroupChats
 * BotCommandScopeAllChatAdministrators
 * BotCommandScopeChat
 * BotCommandScopeChatAdministrators
 * BotCommandScopeChatMember
 *
 * Objects defined as-is June 2021, Bot API v5.3
 *
 * @see https://core.telegram.org/bots/api#botcommandscope
 */
class BotCommandScope extends TelegramTypes
{
    /**
     * Scope type
     *
     * @var string
     */
    public $type = 'default';
}

<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\MethodDefinitions;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in
 * form of a User object.
 *
 * @see https://core.telegram.org/bots/api#getme
 */
class GetMe implements MethodDefinitions
{
    public static function apiMethod(): string
    {
        return 'getMe';
    }

    public static function objectType(): string
    {
        return 'User';
    }
}

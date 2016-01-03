<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in
 * form of a User object.
 *
 * @see https://core.telegram.org/bots/api#getme
 */
class GetMe extends AbstractMethodFunctions
{
    public static function apiMethod(): string
    {
        return 'getMe';
    }

    public static function bindToObjectType(): string
    {
        return 'User';
    }
}

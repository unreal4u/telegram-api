<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in
 * form of a User object.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getme
 */
class GetMe extends TelegramMethods
{
    public static function bindToObjectType(): string
    {
        return 'User';
    }
}

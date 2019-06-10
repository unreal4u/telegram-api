<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents the LoginUrl object to use for the seamless telegram login feature.
 *
 * Objects defined as-is june 2019
 *
 * @see https://core.telegram.org/bots/api#loginurl
 */
class LoginUrl extends TelegramTypes
{
    /**
     * An HTTP URL to be opened with user authorization data added to the query string when the button is pressed.
     * If the user refuses to provide authorization data, the original URL without information about the user will be
     * opened.
     * The data added is the same as described in Receiving authorization data:
     *
     * @see https://core.telegram.org/widgets/login#receiving-authorization-dat
     *
     * @var string
     */
    public $url = '';

    /**
     * Optional. New text of the button in forwarded messages.
     * @var string
     */
    public $forward_text = '';

    /**
     * Optional. Username of a bot, which will be used for user authorization.
     * @var string
     */
    public $bot_username = '';

    /**
     * Optional. Pass True to request the permission for your bot to send messages to the user.
     * @var bool
     */
    public $request_write_access = false;
}

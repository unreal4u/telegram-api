<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a bot command.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#botcommand
 */
class BotCommand extends TelegramTypes
{
    /**
     * Text of the command, 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     * @var string
     */
    public $command;

    /**
     * Description of the command, 3-256 characters.
     * @var string
     */
    public $description;
}

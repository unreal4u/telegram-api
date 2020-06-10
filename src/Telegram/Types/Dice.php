<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an animated emoji that displays a random value.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#dice
 */
class Dice extends TelegramTypes
{
    /**
     * Emoji on which the dice throw animation is based
     * @var string
     */
    public $emoji;

    /**
     * Value of the dice, 1-6 for “🎲” and “🎯” base emoji, 1-5 for “🏀” base emoji
     * @var int
     */
    public $value;
}

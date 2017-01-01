<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods\EditMessage;

use unreal4u\TelegramAPI\Telegram\Methods\EditMessage;

/**
 * Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success, if edited
 * message is sent by the bot, the edited Message is returned, otherwise True is returned.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#editmessagecaption
 */
class Caption extends EditMessage
{
    /**
     * New caption of the message
     * @var string
     */
    public $caption = '';
}

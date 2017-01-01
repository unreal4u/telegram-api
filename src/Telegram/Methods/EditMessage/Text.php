<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods\EditMessage;

use unreal4u\TelegramAPI\Telegram\Methods\EditMessage;

/**
 * Use this method to edit text messages sent by the bot or via the bot (for inline bots). On success, if edited message
 * is sent by the bot, the edited Message is returned, otherwise True is returned
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#editmessagetext
 */
class Text extends EditMessage
{
    /**
     * New text of the message
     * @var string
     */
    public $text = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in your bot's message
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Disables link previews for links in this message
     * @var boolean
     */
    public $disable_web_page_preview = false;

    public function getMandatoryFields(): array
    {
        $mandatoryFields = parent::getMandatoryFields();
        $mandatoryFields[] = 'text';

        return $mandatoryFields;
    }
}

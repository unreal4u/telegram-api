<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * Objects defined as-is july 2015
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 *
 * @see https://core.telegram.org/bots/api#inputmessagecontent
 */
class Text extends InputMessageContent
{
    /**
     * Text of the message to be sent, 1-4096 characters
     * @var string
     */
    public $message_text = '';

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in your bot's message.
     * @var string
     */
    public $parse_mode = '';

    /**
     * Optional. Disables link previews for links in the sent message
     * @var bool
     */
    public $disable_web_page_preview = false;
}

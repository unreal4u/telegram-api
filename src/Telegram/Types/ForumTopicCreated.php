<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a service message about a new forum topic created in the chat.
 *
 * Objects defined as-is march 2023, Bot API v6.3
 *
 * @see https://core.telegram.org/bots/api#forumtopiccreated
 */
class ForumTopicCreated extends TelegramTypes
{
    /**
     * Name of the topic
     * @var string
     */
    public $name = '';

    /**
     * Color of the topic icon in RGB format
     * @var int
     */
    public $icon_color = 0;

    /**
     * Optional. Unique identifier of the custom emoji shown as the topic icon
     * @var string
     */
    public $icon_custom_emoji_id = '';
}

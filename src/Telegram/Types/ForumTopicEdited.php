<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents a service message about an edited forum topic
 *
 * Objects defined as-is march 2023, Bot API v6.3
 *
 * @see https://core.telegram.org/bots/api#forumtopicedited
 */
class ForumTopicEdited extends TelegramTypes
{
    /**
     * Optional. New name of the topic, if it was edited
     * @var string
     */
    public $name = '';

    /**
     * Optional. New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the
     * icon was removed
     * @var string
     */
    public $icon_custom_emoji_id = '';
}

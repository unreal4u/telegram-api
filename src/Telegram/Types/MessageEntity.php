<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#messageentity
 */
class MessageEntity extends TelegramTypes
{
    /**
     * Type of the entity. Can be mention (@username), hashtag, bot_command, url, email, bold (bold text), italic
     * (italic text), code (monowidth string), pre (monowidth block), text_link (for clickable text URLs), text_mention
     * (for users without usernames)
     * @var string
     */
    public $type = '';

    /**
     * Offset in UTF-16 code units to the start of the entity
     * @var int
     */
    public $offset = 0;

    /**
     * Length of the entity in UTF-16 code units
     * @var int
     */
    public $length = 0;

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text
     * @var string
     */
    public $url = '';

    /**
     * Optional. For “text_mention” only, the mentioned user
     * @var User
     */
    public $user;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

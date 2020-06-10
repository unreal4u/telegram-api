<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * Objects defined as-is June 2020, Bot API v4.9
 *
 * @see https://core.telegram.org/bots/api#messageentity
 */
class MessageEntity extends TelegramTypes
{
    /**
     * Type of the entity. Can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command”
     * (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number”
     * (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough”
     * (strikethrough text), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs),
     * “text_mention” (for users without usernames)
     *
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

    /**
     * Optional. For “pre” only, the programming language of the entity text
     * @var string
     */
    public $language;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use unreal4u\TelegramAPI\Interfaces\TelegramMethodDefinitions;

/**
 * Contains methods that all Telegram methods should implement
 */
abstract class TelegramMethods implements TelegramMethodDefinitions
{
    /**
     * Most of the methods will return a Message object on success, so set that as default.
     *
     * @return string
     */
    public static function bindToObjectType(): string
    {
        return 'Message';
    }

    /**
     * Special transformations can be done in this method, before making the actual request this method will be called
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods
    {
        if (!empty($this->reply_markup)) {
            $this->reply_markup = json_encode($this->reply_markup);
        }

        return $this;
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Passport;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents information about an order
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class PassportData extends TelegramTypes
{
    /**
     * Array with information about documents and other Telegram Passport elements that was shared with the bot
     * @var string
     */
    public $data;

    /**
     * Encrypted credentials required to decrypt the data
     * @var EncryptedCredentials
     */
    public $credentials;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'data':
                // TODO
            case 'credentials':
                return new EncryptedCredentials($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

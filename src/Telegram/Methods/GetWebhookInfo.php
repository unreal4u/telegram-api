<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\WebhookInfo;

/**
 * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If
 * the bot is using getUpdates, will return an object with the url field empty.
 *
 * Objects defined as-is october 2016
 *
 * @see https://core.telegram.org/bots/api/#getwebhookinfo
 */
class GetWebhookInfo extends TelegramMethods
{
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new WebhookInfo($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}

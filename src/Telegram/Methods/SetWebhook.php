<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update
 * for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of
 * an unsuccessful request, we will give up after a reasonable amount of attempts.
 *
 * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL,
 * e.g. https://www.example.com/<token>. Since nobody else knows your bot‘s token, you can be pretty sure it’s us.
 *
 * Notes
 * <ul>
 *  <li>You will not be able to receive updates using getUpdates for as long as an outgoing webhook is set up.</li>
 *  <li>To use a self-signed certificate, you need to upload your public key certificate using certificate parameter.
 *      Please upload as InputFile, sending a String will not work.</li>
 *  <li>Ports currently supported for Webhooks: 443, 80, 88, 8443.</li>
 * </ul>
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#setwebhook
 */
class SetWebhook extends TelegramMethods
{
    /**
     * Optional. HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @var string
     */
    public $url = '';

    /**
     * Optional. Upload your public key certificate so that the root certificate in use can be checked. See our
     * self-signed guide for details.
     * @var string
     */
    public $certificate = '';

    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}

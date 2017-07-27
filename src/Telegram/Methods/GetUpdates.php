<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UpdatesArray;

/**
 * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#getupdates
 */
class GetUpdates extends TelegramMethods
{
    /**
     * Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of
     * previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An
     * update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The
     * negative offset can be specified to retrieve updates starting from -offset update from the end of the updates
     * queue. All previous updates will forgotten
     * @var int
     */
    public $offset = 0;

    /**
     * Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100
     * @var int
     */
    public $limit = 100;

    /**
     * Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling
     * @var int
     */
    public $timeout = 0;

    /**
     * List the types of updates you want your bot to receive. For example, specify
     * [“message”, “edited_channel_post”, “callback_query”]
     * to only receive updates of these types. See Update for a complete list of available update types. Specify an
     * empty list to receive all updates regardless of type (default). If not specified, the previous setting will be
     * used.
     *
     * Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted
     * updates may be received for a short period of time.
     * @see Update
     * @var string[]
     */
    public $allowed_updates = [];

    /**
     * This call will return an array with updates, so call up a custom type to do this
     *
     * @param TelegramResponse $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new UpdatesArray($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}

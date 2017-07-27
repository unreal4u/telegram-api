<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\UserProfilePhotos;

/**
 * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#getuserprofilephotos
 */
class GetUserProfilePhotos extends TelegramMethods
{
    /**
     * Unique identifier of the target user
     * @var int
     */
    public $user_id = 0;

    /**
     * Optional. Sequential number of the first photo to be returned. By default, all photos are returned.
     * @var int
     */
    public $offset = 0;

    /**
     * Optional. Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     * @var int
     */
    public $limit = 100;

    /**
     * This call will return an array with updates, so call up a custom type to do this
     *
     * @param TelegramResponse $data
     * @param LoggerInterface $logger
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new UserProfilePhotos($data->getResult(), $logger);
    }

    public function getMandatoryFields(): array
    {
        return [
            'user_id',
        ];
    }
}

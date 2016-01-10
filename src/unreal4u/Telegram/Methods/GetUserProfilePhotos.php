<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Methods;

use unreal4u\InternalFunctionality\AbstractMethodFunctions;

/**
 * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 *
 * @see https://core.telegram.org/bots/api#getuserprofilephotos
 */
class GetUserProfilePhotos extends AbstractMethodFunctions
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
     * @return string
     */
    public static function bindToObjectType(): string
    {
        return 'UserProfilePhotos';
    }
}

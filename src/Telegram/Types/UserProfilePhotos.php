<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UserProfilePhotosArray;

/**
 * This object represent a user's profile pictures.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#userprofilephotos
 */
class UserProfilePhotos extends TelegramTypes
{
    /**
     * Total number of profile pictures the target user has
     * @var int
     */
    public $total_count = 0;

    /**
     * Requested profile pictures (in up to 4 sizes each)
     * NOTE: Is an array of an array of PhotoSize objects
     *
     * @var UserProfilePhotosArray[]
     */
    public $photos = [];

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'photos':
                return new UserProfilePhotosArray($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

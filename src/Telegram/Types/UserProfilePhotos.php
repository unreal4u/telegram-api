<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\Abstracts\TelegramTypes;

/**
 * This object represent a user's profile pictures.
 *
 * Objects defined as-is january 2016
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
     * @var array
     */
    public $photos = [];

    protected function mapSubObjects(): array
    {
        return [
            'photos' => 'Custom\\UserProfilePhotosArray',
        ];
    }
}

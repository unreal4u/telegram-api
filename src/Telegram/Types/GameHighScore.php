<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PhotoSizeArray;

/**
 * This object represents one row of the high scores table for a game
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#gamehighscore
 */
class GameHighScore extends TelegramTypes
{
    /**
     * Position in high score table for the game
     * @var string
     */
    public $position = 0;

    /**
     * User
     * @var string
     */
    public $user;

    /**
     * Score
     * @var PhotoSize[]
     */
    public $score = 0;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'user':
                return new User($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

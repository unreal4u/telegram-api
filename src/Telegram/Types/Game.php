<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PhotoSizeArray;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique
 * identifiers
 *
 * Objects defined as-is December 2016
 *
 * @see https://core.telegram.org/bots/api#game
 */
class Game extends TelegramTypes
{
    /**
     * Title of the game
     * @var string
     */
    public $title = '';

    /**
     * Description of the game
     * @var string
     */
    public $description = '';

    /**
     * Photo that will be displayed in the game message in chats
     * @var PhotoSize[]
     */
    public $photo = [];

    /**
     * Optional. Brief description of the game or high scores included in the game message. Can be automatically edited
     * to include current high scores for the game when the bot calls setGameScore, or manually edited using
     * editMessageText. 0-4096 characters
     * @var int
     */
    public $text = '';

    /**
     * Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc
     * @var MessageEntity[]
     */
    public $text_entities = [];

    /**
     * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
     * @var Animation
     */
    public $animation;

    public function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'photo':
                return new PhotoSizeArray($data, $this->logger);
            case 'text_entities':
                return new MessageEntityArray($data, $this->logger);
            case 'animation':
                return new Animation($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}

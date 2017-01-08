<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use unreal4u\TelegramAPI\Telegram\Types\ChatMember;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Telegram\Types\GameHighScore;

/**
 * Mockup class to generate a real telegram GameHighScore representation
 */
class GameHighScoreArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $id => $gameHighScore) {
                $this->data[$id] = new GameHighScore($gameHighScore, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return GameHighScore[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $gameHighScore) {
            yield $gameHighScore;
        }
    }
}

<?php
declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TraversableCustomType;
use unreal4u\TelegramAPI\Telegram\Types\BotCommand;
use function count;

/**
 * Used for methods that will return an array of Bot Commands
 */
class BotCommandArray extends TraversableCustomType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (count($data) !== 0) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new BotCommand($telegramResponse, $logger);
            }
        }
    }
}

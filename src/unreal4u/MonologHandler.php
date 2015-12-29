<?php

declare(strict_types = 1);

namespace unreal4u;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use unreal4u\Telegram\Methods\SendMessage;

/**
 * Extends monolog to handle Telegram Messages
 */
class MonologHandler extends AbstractProcessingHandler
{
    /**
     * Holds Telegram object
     * @var TelegramLog
     */
    private $tgLog = null;

    /**
     * Which chat id the message should be sent to
     * @var int
     */
    private $chatId = 0;

    /**
     * MonologHandler constructor.
     *
     * @param TelegramLog $tgLog
     * @param int $chatId
     * @param int $level
     * @param bool $bubble
     */
    public function __construct(TelegramLog $tgLog, int $chatId, $level = Logger::DEBUG, $bubble = true)
    {
        $this->tgLog = $tgLog;
        $this->chatId = $chatId;
        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     * @return $this
     */
    public function write(array $record)
    {
        $sendMessage = new SendMessage();
        $sendMessage->text = $record['formatted'];
        $sendMessage->chat_id = $this->chatId;

        $this->tgLog->performApiRequest($sendMessage);
        return $this;
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\Filler;

/**
 * This object represents a chat.
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#chat
 */
class Chat extends Filler
{
    /**
     * Unique identifier for this chat, not exceeding 1e13 by absolute value
     * @var int
     */
    public $id = 0;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var string
     */
    public $type = '';

    /**
     * Optional. Title, for channels and group chats
     * @var string
     */
    public $title = '';

    /**
     * Optional. Title, for channels and group chats
     * @var string
     */
    public $username = '';

    /**
     * Optional. First name of the other party in a private chat
     * @var string
     */
    public $first_name = '';

    /**
     * Optional. Last name of the other party in a private chat
     * @var string
     */
    public $last_name = '';

    public function __construct(\stdClass $data = null)
    {
        $this->populateObject($data);
    }
}

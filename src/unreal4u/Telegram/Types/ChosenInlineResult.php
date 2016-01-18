<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\Abstracts\TelegramTypes;

/**
 * This object represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * Objects defined as-is january 2016
 *
 * @see https://core.telegram.org/bots/api#choseninlineresult
 */
class ChosenInlineResult extends TelegramTypes
{
    /**
     * The unique identifier for the result that was chosen
     * @var string
     */
    public $result_id = '';

    /**
     * The user that chose the result
     * @var User
     */
    public $from = null;

    /**
     * Text of the query
     * @var string
     */
    public $query = '';

    protected function mapSubObjects(): array
    {
        return [
            'from' => 'User',
        ];
    }
}

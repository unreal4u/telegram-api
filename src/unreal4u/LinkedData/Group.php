<?php

declare(strict_types = 1);

namespace unreal4u\LinkedData;

class Group
{
    public $internalIdentifier = '';
    public $chatId = '';

    public function __construct(array $group = [])
    {
        $this->internalIdentifier = $group['internalIdentifier'];
        $this->chatId = $group['chatId'];
    }
}

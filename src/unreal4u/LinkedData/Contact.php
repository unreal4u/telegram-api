<?php

declare(strict_types = 1);

namespace unreal4u\LinkedData;

class Contact
{
    public $internalIdentifier = '';
    public $chatId = '';

    public function __construct(array $contact = [])
    {
        $this->internalIdentifier = $contact['internalIdentifier'];
        $this->chatId = $contact['chatId'];
    }
}

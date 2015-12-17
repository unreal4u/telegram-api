<?php

namespace unreal4u;

class Contact
{
    public $name = '';
    public $id = '';
    public $telegramId = '';

    public function __construct(array $contact = [])
    {
        $this->name = $contact['name'];
        $this->id = $contact['id'];
        $this->telegramId = $contact['telegramId'];
    }
}
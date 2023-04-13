<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Types\Custom;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class InputFileTest extends TestCase
{
    public function testInvalidFile()
    {
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\FileNotReadable::class);
        new InputFile('non-existant-file.txt');
    }
}

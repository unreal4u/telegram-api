<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Types\Custom;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class InputFileTest extends TestCase
{
    /**
     * @expectedException \unreal4u\TelegramAPI\Exceptions\FileNotReadable
     */
    public function testInvalidFile()
    {
        new InputFile('non-existant-file.txt');
    }
}

<?php

namespace tests\Telegram\Types\Custom;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

class InputFileTest extends TestCase
{
    /**
     * @expectedException unreal4u\TelegramAPI\Exceptions\FileNotReadable
     */
    public function testInvalidFile()
    {
        #$this->setExpectedException('unreal4u\\TelegramAPI\\Exceptions\\FileNotReadable');
        new InputFile('non-existant-file.txt');
    }
}

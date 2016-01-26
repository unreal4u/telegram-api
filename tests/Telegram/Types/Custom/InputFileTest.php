<?php

namespace tests\Telegram\Types\Custom;

use unreal4u\Telegram\Types\Custom\InputFile;

class InputFileTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidFile()
    {
        $this->setExpectedException('unreal4u\\Exceptions\\FileNotReadable');
        new InputFile('non-existant-file.txt');
    }
}

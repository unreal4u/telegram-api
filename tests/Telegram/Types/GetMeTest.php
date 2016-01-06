<?php

use unreal4u\Telegram\Methods\GetMe;

class GetMeTest extends PHPUnit_Framework_TestCase
{
    public function test_bindToObjectType()
    {
        $type = GetMe::bindToObjectType();
        $this->assertEquals('User', $type);
    }
}

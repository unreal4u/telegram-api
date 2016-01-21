<?php

namespace tests\Telegram\Types;

use unreal4u\Telegram\Types\Update;

class UpdateTest extends \PHPUnit_Framework_TestCase
{
    public function testInlineQuery()
    {
        $updateObject = new Update([
            'update_id' => 123498765,
            'inline_query' => [
                'id' => 12345678901234567,
                'from' => [
                    'id' => 12341234,
                    'first_name' => 'Camilo',
                    'last_name' => 'Sperberg',
                    'username' => 'unreal4u',
                ],
                'query' => 'let\'s ask something!',
                'offset' => '',
            ],
        ]);

        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\Update', $updateObject);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\InlineQuery', $updateObject->inline_query);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\User', $updateObject->inline_query->from);
        $this->assertNull($updateObject->message);
        $this->assertNull($updateObject->chosen_inline_result);
    }
}

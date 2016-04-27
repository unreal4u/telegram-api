<?php

namespace tests\Telegram\Types;

use unreal4u\TelegramAPI\Telegram\Types\Update;

class UpdateTest extends \PHPUnit_Framework_TestCase
{
    private $dataProvider = [
        'inlineQuery' => [
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
        ],
        'inlineResult' => [
            'update_id' => 123451234,
            'chosen_inline_result' => [
                'from' => [
                    'id' => 12341234,
                    'first_name' => 'Camilo',
                    'last_name' => 'Sperberg',
                    'username' => 'unreal4u',
                ],
                'query' => 'what is love?',
                'result_id' => '2368eee6cf37da22bc64034c87c3b0b8',
            ],
        ],
    ];

    public function testInlineQuery()
    {
        $updateObject = new Update($this->dataProvider['inlineQuery']);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Update', $updateObject);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Inline\\Query', $updateObject->inline_query);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $updateObject->inline_query->from);
        $this->assertNull($updateObject->message);
        $this->assertNull($updateObject->chosen_inline_result);
    }

    public function testChosenInlineResult()
    {
        $updateObject = new Update($this->dataProvider['inlineResult']);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Update', $updateObject);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Inline\\ChosenResult', $updateObject->chosen_inline_result);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $updateObject->chosen_inline_result->from);
        $this->assertNull($updateObject->message);
        $this->assertNull($updateObject->inline_query);
        $this->assertNotEmpty($updateObject->chosen_inline_result->query);
        $this->assertNotEmpty($updateObject->chosen_inline_result->result_id);
    }
}

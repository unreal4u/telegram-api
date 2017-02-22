<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Types;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\Inline\ChosenResult;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query;
use unreal4u\TelegramAPI\Telegram\Types\Update;
use unreal4u\TelegramAPI\Telegram\Types\User;

class UpdateTest extends TestCase
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

        $this->assertInstanceOf(Update::class, $updateObject);
        $this->assertInstanceOf(Query::class, $updateObject->inline_query);
        $this->assertInstanceOf(User::class, $updateObject->inline_query->from);
        $this->assertNull($updateObject->message);
        $this->assertNull($updateObject->chosen_inline_result);
    }

    public function testChosenInlineResult()
    {
        $updateObject = new Update($this->dataProvider['inlineResult']);

        $this->assertInstanceOf(Update::class, $updateObject);
        $this->assertInstanceOf(ChosenResult::class, $updateObject->chosen_inline_result);
        $this->assertInstanceOf(User::class, $updateObject->chosen_inline_result->from);
        $this->assertNull($updateObject->message);
        $this->assertNull($updateObject->inline_query);
        $this->assertNotEmpty($updateObject->chosen_inline_result->query);
        $this->assertNotEmpty($updateObject->chosen_inline_result->result_id);
    }
}

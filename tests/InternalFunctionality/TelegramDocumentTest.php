<?php

namespace unreal4u\TelegramAPI\tests\InternalFunctionality;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramDocument;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

class TelegramDocumentTest extends TestCase
{
    public function testToString()
    {
        $headers = [
            'Content-Type' => [
                'text'
            ],
            'Content-Length' => [
                20
            ]
        ];
        $tgResponse = new TelegramResponse('{"ok":true,"result":"test"}', $headers);
        $tgDocument = new TelegramDocument($tgResponse);
        
        $this->assertEquals('test', (string) $tgDocument);
    }
}

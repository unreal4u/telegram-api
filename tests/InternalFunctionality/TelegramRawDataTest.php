<?php

namespace unreal4u\TelegramAPI\tests\InternalFunctionality;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Exceptions\ClientException;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;

class TelegramRawDataTest extends TestCase
{
    public static function providerGetTypeOfResult(): array
    {
        $mapValues[] = ['{"ok":true,"result":{"file_id":"XYZ","file_size":5254,"file_path":"voice\/file_8"}}', 'array'];
        $mapValues[] = ['{"ok":true,"result":[]}', 'array'];
        $mapValues[] = ['{"ok":true,"result":true}', 'boolean'];
        $mapValues[] = ['{"ok":true,"result":false}', 'boolean'];
        $mapValues[] = ['{"ok":true,"result":42}', 'integer'];

        return $mapValues;
    }

    /**
     * @dataProvider providerGetTypeOfResult
     * @param $data
     * @param $expectedResult
     */
    public function testGetTypeOfResult($data, $expectedResult)
    {
        $tgRawData = new TelegramResponse($data);
        $actualResult = $tgRawData->getTypeOfResult();

        $this->assertSame($expectedResult, $actualResult);
    }

    public static function providerGetInvalidTypeOfResult(): array
    {
        $mapValues[] = ['{"ok":true,"result":"hello world"}'];
        $mapValues[] = ['{"ok":true,"result":3.1415}'];
        $mapValues[] = ['{"ok":true,"result":null}'];

        return $mapValues;
    }

    /**
     * @dataProvider providerGetInvalidTypeOfResult
     */
    public function testGetInvalidTypeOfResult($data)
    {
        $this->expectException(\unreal4u\TelegramAPI\Exceptions\InvalidResultType::class);
        $tgRawData = new TelegramResponse($data);
        $tgRawData->getTypeOfResult();
    }

    public function testGetStringBack()
    {
        $tgRawData = new TelegramResponse('{"ok":true,"result":"test"}');
        $actualResult = $tgRawData->getResultString();

        $this->assertSame('test', $actualResult);
    }

    public function testGetArrayBack()
    {
        $tgRawData = new TelegramResponse('{"ok":true,"result":{"file_id":"XYZ","file_size":123,"file_path":"file_8"}}');
        $actualResult = $tgRawData->getResult();

        $this->assertEquals(['file_id' => 'XYZ', 'file_size' => 123, 'file_path' => 'file_8'], $actualResult);
    }

    public function testGetIntBack()
    {
        $tgRawData = new TelegramResponse('{"ok":true,"result":42}');
        $actualResult = $tgRawData->getResultInt();

        $this->assertSame(42, $actualResult);
    }

    public function testGetBooleanFalseBack()
    {
        $tgRawData = new TelegramResponse('{"ok":true,"result":false}');
        $actualResult = $tgRawData->getResultBoolean();

        $this->assertFalse($actualResult);
    }

    public function testGetBooleanTrueBack()
    {
        $tgRawData = new TelegramResponse('{"ok":true,"result":true}');
        $actualResult = $tgRawData->getResultBoolean();

        $this->assertTrue($actualResult);
    }

    public function testGetRawData()
    {
        $data = '{"ok":true,"result":true}';
        $tgResponse = new TelegramResponse($data);
        
        $this->assertEquals($data, $tgResponse->getRawData());
    }

    public function testGetHeaders()
    {
        $headers = [
            'Content-Type: test',
        ];
        $tgResponse = new TelegramResponse('{"ok":true,"result":true}', $headers);
        $this->assertSame($headers, $tgResponse->getHeaders());
    }

    public function testEmptyResponse()
    {
        $this->expectException(ClientException::class);
        $tgResponse = new TelegramResponse('{"ok":false}');
    }

    /**
     * @TODO Test this better, with more options and things that could go wrong
     */
    public function testBadBotTokenResponse()
    {
        $this->expectException(ClientException::class);
        $tgResponse = new TelegramResponse('{"ok":false,"error_code":401,"description":"Unauthorized"}');
    }
}

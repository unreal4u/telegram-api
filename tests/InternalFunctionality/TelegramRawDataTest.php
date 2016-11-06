<?php

namespace unreal4u\TelegramAPI\tests\InternalFunctionality;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;

class TelegramRawDataTest extends TestCase
{
    public function providerGetTypeOfResult()
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
        $tgRawData = new TelegramRawData($data);
        $actualResult = $tgRawData->getTypeOfResult();

        $this->assertSame($expectedResult, $actualResult);
    }

    public function providerGetInvalidTypeOfResult()
    {
        $mapValues[] = ['{"ok":true,"result":"hello world"}'];
        $mapValues[] = ['{"ok":true,"result":3.1415}'];
        $mapValues[] = ['{"ok":true,"result":null}'];

        return $mapValues;
    }

    /**
     * @dataProvider providerGetInvalidTypeOfResult
     * @param $data
     * @expectedException unreal4u\TelegramAPI\Exceptions\InvalidResultType
     */
    public function testGetInvalidTypeOfResult($data)
    {
        $tgRawData = new TelegramRawData($data);
        $tgRawData->getTypeOfResult();
    }

    public function testGetArrayBack()
    {
        $tgRawData = new TelegramRawData('{"ok":true,"result":{"file_id":"XYZ","file_size":123,"file_path":"file_8"}}');
        $actualResult = $tgRawData->getResult();

        $this->assertEquals(['file_id' => 'XYZ', 'file_size' => 123, 'file_path' => 'file_8'], $actualResult);
    }

    public function testGetIntBack()
    {
        $tgRawData = new TelegramRawData('{"ok":true,"result":42}');
        $actualResult = $tgRawData->getResultInt();

        $this->assertSame(42, $actualResult);
    }

    public function testGetBooleanFalseBack()
    {
        $tgRawData = new TelegramRawData('{"ok":true,"result":false}');
        $actualResult = $tgRawData->getResultBoolean();

        $this->assertFalse($actualResult);
    }

    public function testGetBooleanTrueBack()
    {
        $tgRawData = new TelegramRawData('{"ok":true,"result":true}');
        $actualResult = $tgRawData->getResultBoolean();

        $this->assertTrue($actualResult);
    }
}

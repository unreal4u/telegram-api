<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\GetFile;
use unreal4u\TelegramAPI\Telegram\Types\File;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

class GetFileTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void
    {
        $this->tgLog = null;
    }

    public function testGetFile()
    {
        $getFile = new GetFile();
        $getFile->file_id = 'XXXYYYZZZ';

        $promise = $this->tgLog->performApiRequest($getFile);

        $promise->then(function (File $result) {
            $this->assertInstanceOf(File::class, $result);
            $this->assertEquals('XXXYYYZZZ', $result->file_id);
            $this->assertEquals('voice/file_8', $result->file_path);
        });
    }

    public function testGetFileInvalidFileId()
    {
        $getFile = new GetFile();
        $getFile->file_id = 'XYZ';

        $this->tgLog->specificTest = 'invalidFileId';
        $this->tgLog->mockException = true;

        try {
            $this->tgLog->performApiRequest($getFile);
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(400, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }
}

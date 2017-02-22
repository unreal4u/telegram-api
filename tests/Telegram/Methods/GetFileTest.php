<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Types\File;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetFile;

class GetFileTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tgLog = null;
        parent::tearDown();
    }

    public function testGetFile()
    {
        $getFile = new GetFile();
        $getFile->file_id = 'XXXYYYZZZ';

        /** @var File $result */
        $result = $this->tgLog->performApiRequest($getFile);
        $this->assertInstanceOf(File::class, $result);
        $this->assertEquals('XXXYYYZZZ', $result->file_id);
        $this->assertEquals('voice/file_8', $result->file_path);
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

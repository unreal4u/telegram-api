<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\tests\Mock\MockClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos;
use unreal4u\TelegramAPI\Telegram\Types\UserProfilePhotos;
use unreal4u\TelegramAPI\Telegram\Types\PhotoSize;

class GetUserProfilePhotosTest extends TestCase
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

    /**
     * Tests a private message "Hello bot" to the bot
     */
    public function testGetUserProfilePhotos()
    {
        $getUserProfilePhotos = new GetUserProfilePhotos();
        $getUserProfilePhotos->user_id = 123456789;

        /** @var UserProfilePhotos $result */
        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);
        $this->assertInstanceOf(UserProfilePhotos::class, $result);
        $this->assertContainsOnlyInstancesOf(PhotoSize::class, $result->photos[0]);
        $this->assertCount(3, $result->photos[0]);
        $this->assertEquals(1, $result->total_count);

        $i = 1;
        foreach ($result->photos[0] as $photo) {
            $this->assertEquals(sprintf('XXX-YYY-ZZZ-0%d', $i), $photo->file_id);
            $i++;
        }
    }

    public function testGetUserProfilePhotosMultiplePhotos()
    {
        $this->tgLog->specificTest = 'multiplePhotos';

        $getUserProfilePhotos = new GetUserProfilePhotos();
        $getUserProfilePhotos->user_id = 123456789;
        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);

        $this->assertInstanceOf(UserProfilePhotos::class, $result);
        $this->assertCount(2, $result->photos);
        $this->assertCount(4, $result->photos[0]);
        $this->assertCount(3, $result->photos[1]);
    }

    public function testGetUserProfilePhotosNoPhotos()
    {
        $this->tgLog->specificTest = 'noPhotos';

        $getUserProfilePhotos = new GetUserProfilePhotos();
        $getUserProfilePhotos->user_id = 123456789;
        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);

        $this->assertInstanceOf(UserProfilePhotos::class, $result);
        $this->assertCount(0, $result->photos);
    }

    public function testGetUserProfilePhotosInvalidUser()
    {
        $this->tgLog->specificTest = 'invalidUser';
        $this->tgLog->mockException = true;

        try {
            $getUserProfilePhotos = new GetUserProfilePhotos();
            $getUserProfilePhotos->user_id = 123456789;
            $this->tgLog->performApiRequest($getUserProfilePhotos);
        } catch (MockClientException $e) {
            $this->assertInstanceOf(\stdClass::class, $e->decodedResponse);
            $this->assertEquals(400, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->expectException(MockClientException::class);
            throw $e;
        }
    }

    public function testCorrectMethodNameReturned()
    {
        $telegramMethod = new GetUserProfilePhotos();
        $return = $telegramMethod->getMethodName();

        $this->assertSame('getUserProfilePhotos', $return);
    }
}

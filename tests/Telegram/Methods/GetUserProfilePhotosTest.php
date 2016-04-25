<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockTgLog;
use tests\Mock\MockClientException;
use unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos;

class GetUserProfilePhotosTest extends \PHPUnit_Framework_TestCase
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
     * Asserts that the GetMe method ALWAYS load in a user type
     */
    public function testBindToObjectType()
    {
        $type = GetUserProfilePhotos::bindToObjectType();
        $this->assertEquals('UserProfilePhotos', $type);
    }

    /**
     * Tests a private message "Hello bot" to the bot
     *
     * @depends testBindToObjectType
     */
    public function testGetUserProfilePhotos()
    {
        $getUserProfilePhotos = new GetUserProfilePhotos();

        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\UserProfilePhotos', $result);
        $this->assertContainsOnlyInstancesOf('unreal4u\\TelegramAPI\\Telegram\\Types\\PhotoSize', $result->photos[0]);
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
        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\UserProfilePhotos', $result);
        $this->assertCount(2, $result->photos);
        $this->assertCount(4, $result->photos[0]);
        $this->assertCount(3, $result->photos[1]);
    }

    public function testGetUserProfilePhotosNoPhotos()
    {
        $this->tgLog->specificTest = 'noPhotos';

        $getUserProfilePhotos = new GetUserProfilePhotos();
        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\UserProfilePhotos', $result);
        $this->assertCount(0, $result->photos);
    }

    public function testGetUserProfilePhotosInvalidUser()
    {
        $this->tgLog->specificTest = 'invalidUser';
        $this->tgLog->mockException = true;

        try {
            $getUserProfilePhotos = new GetUserProfilePhotos();
            $this->tgLog->performApiRequest($getUserProfilePhotos);
        } catch (MockClientException $e) {
            $this->assertInstanceOf('\\stdClass', $e->decodedResponse);
            $this->assertEquals(400, $e->decodedResponse->error_code);

            // Rethrow and set the expected exception this time
            $this->setExpectedException('tests\\Mock\\MockClientException');
            throw $e;
        }
    }
}

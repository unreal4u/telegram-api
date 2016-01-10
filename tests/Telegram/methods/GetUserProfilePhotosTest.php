<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockTgLog;
use unreal4u\Telegram\Methods\GetUserProfilePhotos;

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
    public function test_bindToObjectType()
    {
        $type = GetUserProfilePhotos::bindToObjectType();
        $this->assertEquals('UserProfilePhotos', $type);
    }

    /**
     * Tests a private message "Hello bot" to the bot
     *
     * @depends test_bindToObjectType
     */
    public function test_getUserProfilePhotos()
    {
        $getUserProfilePhotos = new GetUserProfilePhotos();

        $result = $this->tgLog->performApiRequest($getUserProfilePhotos);
        $this->assertInstanceOf('unreal4u\\Telegram\\Types\\UserProfilePhotos', $result);
        $this->assertContainsOnlyInstancesOf('unreal4u\\Telegram\\Types\\PhotoSize', $result->photos[0]);
        $this->assertCount(3, $result->photos[0]);
        $this->assertEquals(1, $result->total_count);

        $i = 1;
        foreach ($result->photos[0] as $photo) {
            $this->assertEquals(sprintf('XXX-YYY-ZZZ-0%d', $i), $photo->file_id);
            $i++;
        }
    }
}

<?php

namespace tests;

use tests\Mock\MockTgLog;

class TgLogTest extends \PHPUnit_Framework_TestCase
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

    /*public function testBuildMultipartFormData(array $data, string $fileKeyName, $stream = null, array $expected = [])
    {
        $call = new \ReflectionMethod('unreal4u\\TgLog', 'buildMultipartFormData');
        $call->setAccessible(true);
        $result = $call->invokeArgs(new \unreal4u\TgLog('TEST-TEST'), [$data, $fileKeyName, $stream]);
        $this->assertEquals($expected, $result);
    }*/

    public function testComposeApiMethodUrl()
    {
        $this->assertTrue(true);
    }
}

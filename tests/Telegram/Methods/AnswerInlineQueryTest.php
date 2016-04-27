<?php

namespace tests\Telegram\Methods;

use tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\AnswerInlineQuery;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Article;

class AnswerInlineQueryTest extends \PHPUnit_Framework_TestCase
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
        $type = AnswerInlineQuery::bindToObjectType();
        $this->assertEquals('Custom\\ResultBoolean', $type);
    }

    /**
     * @depends testBindToObjectType
     */
    public function testAnswerInlineQuery()
    {
        $inlineQueryResultArticle = new Article();
        $inlineQueryResultArticle->url = 'https://unreal4u.com/';
        $inlineQueryResultArticle->title = 'The title';
        $inlineQueryResultArticle->message_text = 'The message text';
        $inlineQueryResultArticle->disable_web_page_preview = true;
        $inlineQueryResultArticle->id = 'unit-test-001';

        $answerInlineQuery = new AnswerInlineQuery();
        $answerInlineQuery->inline_query_id = 123412341234;
        $answerInlineQuery->results[] = $inlineQueryResultArticle;

        $result = $this->tgLog->performApiRequest($answerInlineQuery);

        $this->assertEquals(
            trim(file_get_contents('tests/Mock/MockData/AnswerInlineQueryArticle_unit-test-001.txt')),
            $answerInlineQuery->results
        );

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Custom\\ResultBoolean', $result);
        $this->assertTrue($result->data);
    }
}

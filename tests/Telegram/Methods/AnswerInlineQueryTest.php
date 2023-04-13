<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\Telegram\Methods\AnswerInlineQuery;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Query\Result\Article;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent\Text;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;

//use PHPUnit\Framework\TestCase;

class AnswerInlineQueryTest extends TestCase
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

    public function testAnswerInlineQuery()
    {
        $inlineQueryResultArticle = new Article();
        $inlineQueryResultArticle->url = 'https://unreal4u.com/';
        $inlineQueryResultArticle->title = 'The title';

        $inputMessageContentText = new Text();
        $inputMessageContentText->message_text = 'The message text';
        $inputMessageContentText->disable_web_page_preview = true;
        $inlineQueryResultArticle->id = 'unit-test-001';

        $inlineQueryResultArticle->input_message_content = $inputMessageContentText;
        $inlineQueryResultArticle->id = md5(json_encode(['uid' => '111', 'iqid' => '222', 'rid' => '33']));

        $answerInlineQuery = new AnswerInlineQuery();
        $answerInlineQuery->inline_query_id = 123412341234;
        $answerInlineQuery->addResult($inlineQueryResultArticle);

        $promise = $this->tgLog->performApiRequest($answerInlineQuery);

        $this->assertJsonStringEqualsJsonFile(
            'tests/Mock/MockData/AnswerInlineQueryArticle_unit-test-001.json',
            $answerInlineQuery->getResults()
        );

        $promise->then(function (ResultBoolean $message) {
            $this->assertInstanceOf(ResultBoolean::class, $message->data);
            $this->assertSame('1', $message);
        });
    }
}

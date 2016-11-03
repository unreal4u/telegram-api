<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use unreal4u\TelegramAPI\Telegram\Types\InputMessageContent;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following
 * types:
 *
 * InlineQueryResultCachedAudio
 * InlineQueryResultCachedDocument
 * InlineQueryResultCachedGif
 * InlineQueryResultCachedMpeg4Gif
 * InlineQueryResultCachedPhoto
 * InlineQueryResultCachedSticker
 * InlineQueryResultCachedVideo
 * InlineQueryResultCachedVoice
 * InlineQueryResultArticle
 * InlineQueryResultAudio
 * InlineQueryResultContact
 * InlineQueryResultDocument
 * InlineQueryResultGif
 * InlineQueryResultLocation
 * InlineQueryResultMpeg4Gif
 * InlineQueryResultPhoto
 * InlineQueryResultVenue
 * InlineQueryResultVideo
 * InlineQueryResultVoice
 *
 * Objects defined as-is april 2016
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresult
 */
abstract class Result extends TelegramTypes
{
    /**
     * The type of InlineQueryResult we sent. Is automatically pre-filled by the child
     * @var string
     */
    public $type = '';

    /**
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    public $id = '';

    /**
     * Optional. Inline keyboard attached to the message
     * @var Markup
     */
    public $reply_markup = null;

    /**
     * Optional. Content of the message to be sent instead of the audio/document/voice message/video/sticker/etc.
     * @var InputMessageContent
     */
    public $input_message_content = null;

    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'reply_markup':
                return new Markup($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }

    public function getMandatoryFields(): array
    {
        return [
            'type',
            'id',
        ];
    }

    /**
     * Exports the specific result deleting not needed fields
     *
     * This method is a bit different from the one in TelegramMethods because of mainly 2 reasons:
     *   1- This is not a telegram method
     *   2- This will ignore the "type" field, mandatory for this type of result
     *
     * @return array
     */
    public function export(): array
    {
        $finalArray = [];
        $objectProspect = get_object_vars($this);
        $cleanObject = new $this();
        foreach ($objectProspect as $fieldId => $value) {
            // Strict comparison, type checking!
            if ($fieldId !== 'type' && $objectProspect[$fieldId] === $cleanObject->$fieldId) {
                if (in_array($fieldId, $this->getMandatoryFields())) {
                    throw new MissingMandatoryField(sprintf(
                        'The field "%s" is mandatory and empty, please correct',
                        $fieldId
                    ));
                }
            } else {
                if ($fieldId !== 'logger') {
                    $finalArray[$fieldId] = $value;
                }
            }
        }

        return $finalArray;
    }
}

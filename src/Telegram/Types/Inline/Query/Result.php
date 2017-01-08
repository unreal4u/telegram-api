<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Inline\Query;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following 20
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
 * InlineQueryResultGame
 * InlineQueryResultDocument
 * InlineQueryResultGif
 * InlineQueryResultLocation
 * InlineQueryResultMpeg4Gif
 * InlineQueryResultPhoto
 * InlineQueryResultVenue
 * InlineQueryResultVideo
 * InlineQueryResultVoice
 *
 * Objects defined as-is January 2017
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
    public $reply_markup;

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
     *   3- This must return all fields, so the actual check is actually turned backwards
     *
     * @see TelegramMethods::export
     * @return array
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function export(): array
    {
        $finalArray = [];
        $mandatoryFields = $this->getMandatoryFields();

        $cleanObject = new $this();
        foreach ($cleanObject as $fieldId => $value) {
            if ($fieldId !== 'type' && $this->$fieldId === $cleanObject->$fieldId) {
                if (in_array($fieldId, $mandatoryFields, true)) {
                    throw new MissingMandatoryField(sprintf(
                        'The field "%s" is mandatory and empty, please correct',
                        $fieldId
                    ));
                }
            } else {
                if ($fieldId !== 'logger') {
                    $finalArray[$fieldId] = $this->$fieldId;
                }
            }
        }

        return $finalArray;
    }
}

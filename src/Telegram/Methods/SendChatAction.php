<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\ResultBoolean;

/**
 * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5
 * seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
 *
 * Example: The ImageBot needs some time to process a request and upload the image. Instead of sending a text message
 * along the lines of “Retrieving image, please wait…”, the bot may use sendChatAction with action = upload_photo.
 * The user will see a “sending photo” status for the bot.
 * We only recommend using this method when a response from the bot will take a noticeable amount of time to arrive.
 *
 * Objects defined as-is May 2017
 *
 * @see https://core.telegram.org/bots/api#sendchataction
 */
class SendChatAction extends TelegramMethods
{
    const ACTION_TYPING = 'typing';
    const ACTION_UPLOAD_PHOTO = 'upload_photo';
    const ACTION_RECORD_VIDEO = 'record_video';
    const ACTION_RECORD_AUDIO = 'record_audio';
    const ACTION_UPLOAD_DOCUMENT = 'upload_document';
    const ACTION_FIND_LOCATION = 'find_location';
    const ACTION_RECORD_VIDEO_NOTE = 'record_video_note';
    const ACTION_UPLOAD_VIDEO_NOTE = 'upload_video_note';

    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Type of action to broadcast. Choose one, depending on what the user is about to receive: typing for text
     * messages, upload_photo for photos, record_video or upload_video for videos, record_audio or upload_audio for
     * audio files, upload_document for general files, find_location for location data, record_video_note or
     * upload_video_note for video notes.
     * @var string
     */
    public $action = '';

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'action',
        ];
    }

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new ResultBoolean($data->getResultBoolean(), $logger);
    }
}

<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;

/**
 * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio
 * must be in the .mp3 format. On success, the sent Message is returned. Bots can currently send audio files of up to
 * 50 MB in size, this limit may be changed in the future.
 *
 * For backward compatibility, when the fields title and performer are both empty and the mime-type of the file to be
 * sent is not audio/mpeg, the file will be sent as a playable voice message. For this to work, the audio must be in an
 * .ogg file encoded with OPUS. This behavior will be phased out in the future. For sending voice messages, use the
 * sendVoice method instead.
 *
 * Objects defined as-is july 2016
 *
 * @see https://core.telegram.org/bots/api#sendaudio
 */
class SendAudio extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * Audio file to send. Associate an InputFile with it
     *
     * @see unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile
     * @var InputFile
     */
    public $audio = null;

    /**
     * Optional. Audio caption, 0-200 characters
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Duration of the audio in seconds
     * @var int
     */
    public $duration = 0;

    /**
     * Optional. Performer
     * @var string
     */
    public $performer = '';

    /**
     * Optional. Track name
     * @var string
     */
    public $title = '';

    /**
     * Optional. Sends the message silently. iOS users will not receive a notification, Android users will receive a
     * notification with no sound.
     * @see https://telegram.org/blog/channels-2-0#silent-messages
     * @var bool
     */
    public $disable_notification = false;

    /**
     * Optional. If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. Additional interface options. A JSON-serialized object for a custom reply keyboard, instructions to
     * hide keyboard or to force a reply from the user
     * @var null
     */
    public $reply_markup = null;

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'audio',
        ];
    }
}

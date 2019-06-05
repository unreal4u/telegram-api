<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Generator;
use Psr\Log\LoggerInterface;
use RuntimeException;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Exceptions\InvalidMediaType;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageArray;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Video;
use function basename;
use function count;
use function is_readable;
use function json_encode;

/**
 * Use this method to send photos. On success, the sent Message is returned
 *
 * Objects defined as-is January 2017
 *
 * @see https://core.telegram.org/bots/api#sendphoto
 */
class SendMediaGroup extends TelegramMethods
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string
     */
    public $chat_id = '';

    /**
     * A JSON-serialized array describing photos and videos to be sent
     * @var InputMedia[]
     */
    public $media = [];

    /**
     * @var InputFile[]
     */
    private $localFiles = [];

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

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'media',
        ];
    }

    public static function bindToObject(TelegramResponse $data, LoggerInterface $logger): TelegramTypes
    {
        return new MessageArray($data->getResult(), $logger);
    }

    public function performSpecialConditions(): TelegramMethods
    {
        $imageQuantity = count($this->media);
        if ($imageQuantity < 2) {
            throw new RuntimeException('Must include at least 2 images');
        }

        if ($imageQuantity > 10) {
            throw new RuntimeException('Can not include more than 10 images');
        }

        $this->performSpecialOperationsOnLocalFiles();
        $this->media = json_encode($this->media);

        return parent::performSpecialConditions();
    }

    /**
     * Helper function that performs some special operations should a local file be detected
     *
     * @return self
     */
    private function performSpecialOperationsOnLocalFiles(): self
    {
        foreach ($this->media as $fileLocation) {
            if (!$fileLocation instanceof Photo && !$fileLocation instanceof Video) {
                throw new InvalidMediaType('To be sent media types can only be Photo or Video');
            }

            if (is_readable($fileLocation->media)) {
                $this->localFiles[basename($fileLocation->media)] = new InputFile($fileLocation->media);
                $fileLocation->media = 'attach://' . basename($fileLocation->media);
            }
        }

        return $this;
    }

    /**
     * @return Generator|InputFile[]
     */
    public function getLocalFiles(): Generator
    {
        yield from $this->localFiles;
    }

    /**
     * Will return true if local files are present, false otherwise
     *
     * @return bool
     */
    public function hasLocalFiles(): bool
    {
        return $this->localFiles !== [];
    }
}

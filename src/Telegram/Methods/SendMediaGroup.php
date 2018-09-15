<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramResponse;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageArray;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;

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
    public $mediagroup = [];

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
    
    /*public function __construct()
    {
      $this->mediagroup = new MediaGroup();
      //return parent::construct();
    }*/
    

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
        $imageQuantity = \count($this->media);
        if ($imageQuantity < 2) {
            throw new \RuntimeException('Must include at least 2 images');
        }

        if ($imageQuantity > 10) {
            throw new \RuntimeException('Can not include more than 10 images');
        }

        //if(is_string(reset($this->media))){
          $this->media = json_encode($this->media);
        //}

        return parent::performSpecialConditions();
    }
    
    public function addMediaStream($key,$path,$caption)
    {
      /*$this->media[$key]=new Photo();
      $this->media[$key]->media= 'attach://'. pathinfo($path, PATHINFO_BASENAME);
      $this->media[$key]->caption=$caption;
      $this->mediagroup[$key]=new InputFile($path);*/
      $phfile=new Photo();
      $phfile->media= 'attach://'. pathinfo($path, PATHINFO_BASENAME);
      $phfile->caption=$caption;
      $this->media[]=$phfile;
      $this->mediagroup[]=new InputFile($path);
      /*$this->{'media_'.$key}=new Photo();
      $this->{'media_'.$key}->media= new InputFile($path);
      $this->{'media_'.$key}->caption=$caption;
      $this->media[$key]=$key;*/
    }
}

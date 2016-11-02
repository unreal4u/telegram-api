<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\Interfaces\TelegramMethodDefinitions;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Message;

/**
 * Contains methods that all Telegram methods should implement
 */
abstract class TelegramMethods implements TelegramMethodDefinitions
{
    /**
     * Most of the methods will return a Message object on success, so set that as the default.
     *
     * This function may however be overwritten if the method uses another object, there are many examples of this, so
     * just check out the rest of the code. A good place to start is GetUserProfilePhotos or LeaveChat
     *
     * @see unreal4u\TelegramAPI\Telegram\Methods\GetUserProfilePhotos
     * @see unreal4u\TelegramAPI\Telegram\Methods\LeaveChat
     *
     * @param TelegramRawData $data
     * @param LoggerInterface $logger
     *
     * @return TelegramTypes
     */
    public static function bindToObject(TelegramRawData $data, LoggerInterface $logger): TelegramTypes
    {
        return new Message($data->getResult(), $logger);
    }

    /**
     * Before making the actual request this method will be called
     *
     * It must be used to json_encode stuff, or do other changes in the internal class representation _before_ sending
     * it to the Telegram servers
     *
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods
    {
        if (!empty($this->reply_markup)) {
            $this->reply_markup = json_encode($this->reply_markup);
        }

        return $this;
    }

    /**
     * Exports the class to an array in order to send it to the Telegram servers
     *
     * @return array
     */
    final public function export(): array
    {
        $finalArray = [];
        $objectProspect = get_object_vars($this);
        $cleanObject = new $this();
        foreach ($objectProspect as $fieldId => $value) {
            // Strict comparison, type checking!
            if ($objectProspect[$fieldId] === $cleanObject->$fieldId) {
                if (in_array($fieldId, $this->getMandatoryFields())) {
                    throw new MissingMandatoryField(sprintf(
                        'The field "%s" is mandatory and empty, please correct',
                        $fieldId
                    ));
                }
            } else {
                $finalArray[$fieldId] = $value;
            }
        }

        return $finalArray;
    }
}

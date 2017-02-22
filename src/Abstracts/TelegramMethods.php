<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Abstracts;

use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Exceptions\MissingMandatoryField;
use unreal4u\TelegramAPI\Interfaces\TelegramMethodDefinitions;
use unreal4u\TelegramAPI\InternalFunctionality\TelegramRawData;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\ReplyKeyboardMarkup;

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
            $this->reply_markup = json_encode($this->formatReplyMarkup($this->reply_markup));
        }

        // Several classes may send a parse mode, so check before sending
        // TODO Do I want to validate data in here? Should I?
        /*
         * if (!empty($this->parse_mode)) {
            if (strtoupper($this->parse_mode) !== 'HTML' || strtoupper($this->parse_mode) !== 'MARKDOWN') {
                throw new InvalidParseMode(sprintf(
                    'An invalid value for parse_mode has been given. Please use HTML or Markdown. Provided: "%s"',
                    $this->parse_mode
                ));
            }
        }
         */

        return $this;
    }

    /**
     * Exports the class to an array in order to send it to the Telegram servers without extra fields that we don't need
     *
     * @return array
     * @throws MissingMandatoryField
     */
    final public function export(): array
    {
        $finalArray = [];
        $mandatoryFields = $this->getMandatoryFields();

        $cleanObject = new $this();
        foreach ($cleanObject as $fieldId => $value) {
            if ($this->$fieldId === $cleanObject->$fieldId) {
                if (in_array($fieldId, $mandatoryFields, true)) {
                    throw new MissingMandatoryField(sprintf(
                        'The field "%s" is mandatory and empty, please correct',
                        $fieldId
                    ));
                }
            } else {
                $finalArray[$fieldId] = $this->$fieldId;
            }
        }

        return $finalArray;
    }

    /**
     * Will resolve the dependency of a mandatory inline_message_id OR a chat_id + message_id
     *
     * NOTE: This will use pass by reference instead of copy on write as the use-case for this functions allows this
     *
     * @param array $return
     * @return array
     */
    final protected function mandatoryUserOrInlineMessageId(array &$return): array
    {
        if (empty($this->chat_id) && empty($this->message_id)) {
            $return[] = 'inline_message_id';
        }

        // On the other hand, chat_id and message_id are mandatory if inline_message_id is not filled in
        if (empty($this->inline_message_id)) {
            $return[] = 'chat_id';
            $return[] = 'message_id';
        }

        return $return;
    }

    /**
     * ReplyMarkup fields require a bit of work before sending them
     *
     * This happens because reply markup are a type thus they don't have an export mechanism to do the job
     *
     * @param TelegramTypes $replyMarkup
     * @return TelegramTypes
     */
    final private function formatReplyMarkup(TelegramTypes $replyMarkup): TelegramTypes
    {
        if ($replyMarkup instanceof Markup) {
            $replyMarkup->inline_keyboard = $this->getArrayFromKeyboard($replyMarkup->inline_keyboard);
        } elseif ($replyMarkup instanceof ReplyKeyboardMarkup) {
            $replyMarkup->keyboard = $this->getArrayFromKeyboard($replyMarkup->keyboard);
        }

        return $replyMarkup;
    }

    final private function getArrayFromKeyboard(array $keyboardArray): array
    {
        $finalCleanArray = [];

        // A keyboard is an array of an array of objects or strings
        foreach ($keyboardArray as $rowItems) {
            $elements = [];
            foreach ($rowItems as $rowItem) {
                if (is_object($rowItem)) {
                    // Button is effectively an object
                    $elements[] = $this->exportReplyMarkupItem($rowItem);
                } else {
                    // Add support for old style simple text buttons
                    $elements[] = $rowItem;
                }
            }

            $finalCleanArray[] = $elements;
        }

        return $finalCleanArray;
    }

    /**
     * Does the definitive export of those fields in a reply markup item that are filled in
     *
     * @param TelegramTypes $markupItem
     * @return array
     */
    final private function exportReplyMarkupItem(TelegramTypes $markupItem): array
    {
        $finalArray = [];
        $cleanObject = new $markupItem;
        foreach ($markupItem as $fieldId => $value) {
            if ($markupItem->$fieldId !== $cleanObject->$fieldId) {
                $finalArray[$fieldId] = $markupItem->$fieldId;
            }
        }

        return $finalArray;
    }
}

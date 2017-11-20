<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Methods;

use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use unreal4u\TelegramAPI\Telegram\Types\LabeledPrice;

/**
 * Use this method to send invoices. On success, the sent Message is returned.
 *
 * Objects defined as-is november 2017
 *
 * @see https://core.telegram.org/bots/api#sendinvoice
 */
class SendInvoice extends TelegramMethods
{
    /**
     * Unique identifier for the target private chat
     * @var int
     */
    public $chat_id = 0;

    /**
     * Product name
     * @var string
     */
    public $title = '';

    /**
     * Product description
     * @var string
     */
    public $description = '';

    /**
     * Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes
     * @var string
     */
    public $payload = '';

    /**
     * Payments provider token, obtained via Botfather
     * @var string
     */
    public $provider_token = '';

    /**
     * Unique deep-linking parameter that can be used to generate this invoice when used as a start parameter
     * @var string
     */
    public $start_parameter = '';

    /**
     * Three-letter ISO 4217 currency code, see more on currencies
     * @see https://core.telegram.org/bots/payments#supported-currencies
     * @var string
     */
    public $currency = '';

    /**
     * Price breakdown, a list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus,
     * etc.)
     * @var LabeledPrice[]
     */
    public $prices = [];

    /**
     * Array data about the invoice, which will be shared with the payment provider. A detailed description of
     * required fields should be provided by the payment provider.
     *
     * The conversion to JSON-encoded string will be handled by the class itself.
     * @var array
     */
    public $provider_data;

    /**
     * Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a
     * service. People like it better when they see what they are paying for
     * @var string
     */
    public $photo_url = '';

    /**
     * Optional. Photo size
     * @var int
     */
    public $photo_size = 0;

    /**
     * Optional. Photo width
     * @var int
     */
    public $photo_width = 0;

    /**
     * Optional. Photo height
     * @var int
     */
    public $photo_height = 0;

    /**
     * Optional. Pass True, if you require the user's full name to complete the order
     * @var bool
     */
    public $need_name = false;

    /**
     * Optional. Pass True, if you require the user's phone number to complete the order
     * @var bool
     */
    public $need_phone_number = false;

    /**
     * Optional. Pass True, if you require the user's email to complete the order
     * @var bool
     */
    public $need_email = false;

    /**
     * Optional. Pass True, if you require the user's shipping address to complete the order
     * @var bool
     */
    public $need_shipping_address = false;

    /**
     * Optional. Pass True, if the final price depends on the shipping method
     * @var bool
     */
    public $is_flexible = false;

    /**
     * Optional. Sends the message silently. Users will receive a notification with no sound.
     * @var bool
     */
    public $disable_notification = false;

    /**
     * Optional. If the message is a reply, ID of the original message
     * @var int
     */
    public $reply_to_message_id = 0;

    /**
     * Optional. A JSON-serialized object for an inline keyboard. If empty, one 'Pay total price' button will be shown.
     * If not empty, the first button must be a Pay button
     * @var Markup
     */
    public $reply_markup;

    /**
     * Prices must be an array of objects, so json_encode() them
     *
     * @see https://github.com/unreal4u/telegram-api/issues/32
     * @return TelegramMethods
     */
    public function performSpecialConditions(): TelegramMethods
    {
        if (!empty($this->prices)) {
            $this->prices = json_encode($this->prices);
        }

        if (!empty($this->provider_data)) {
            $this->provider_data = json_encode($this->provider_data);
        }

        return parent::performSpecialConditions();
    }

    public function getMandatoryFields(): array
    {
        return [
            'chat_id',
            'title',
            'description',
            'payload',
            'provider_token',
            'start_parameter',
            'currency',
            'prices',
        ];
    }
}

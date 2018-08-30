<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Passport;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the
 * user
 *
 * Objects defined as-is july 2018
 *
 * @see https://core.telegram.org/bots/api#passportelementerror
 */
abstract class PassportElementError extends TelegramTypes
{
    /**
     * Error source, must be overwritten by a child
     * @var string
     */
    public $source;

    /**
     * The section of the user's Telegram Passport which has the error, must be overwritten by the specific subclass
     *
     * Allowed values:
     * DataField: one of "personal_details", "passport", "driver_license", "identity_card", "internal_passport",
     *            "address"
     * FrontSide: one of "passport", "driver_license", "identity_card", "internal_passport"
     * ReverseSide: one of "driver_license", "identity_card"
     * Selfie: one of "passport", "driver_license", "identity_card", "internal_passport"
     * File: one of "utility_bill", "bank_statement", "rental_agreement", "passport_registration",
     *       "temporary_registration"
     * Files: one of "utility_bill", "bank_statement", "rental_agreement", "passport_registration",
     *        "temporary_registration"
     *
     * @var int
     */
    public $type = '';

    /**
     * Error message
     * @var string
     */
    public $message = '';
}

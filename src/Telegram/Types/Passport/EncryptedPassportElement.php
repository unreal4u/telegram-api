<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Passport;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PassportFileArray;

/**
 * This object represents information about an order
 *
 * Objects defined as-is may 2017
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 */
class EncryptedPassportElement extends TelegramTypes
{
    /**
     * Element type. One of "personal_details", "passport", "driver_license", "identity_card", "internal_passport",
     * "address", "utility_bill", "bank_statement", "rental_agreement", "passport_registration",
     * "temporary_registration", "phone_number", "email".
     * @var string
     */
    public $type = '';

    /**
     * Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for
     * "personal_details", "passport", "driver_license", "identity_card", "identity_passport" and "address" types. Can
     * be decrypted and verified using the accompanying EncryptedCredentials.
     * @var string
     */
    public $data = '';

    /**
     * Optional. User's verified phone number, available only for "phone_number" type
     * @var string
     */
    public $phone_number = '';

    /**
     * Optional. User's verified email address, available only for "email" type
     * @var string
     */
    public $email = '';

    /**
     * Optional. Array of encrypted files with documents provided by the user, available for "utility_bill",
     * "bank_statement", "rental_agreement", "passport_registration" and "temporary_registration" types. Files can be
     * decrypted and verified using the accompanying EncryptedCredentials.
     * @var PassportFileArray
     */
    public $files;

    /**
     * Optional. Encrypted file with the front side of the document, provided by the user. Available for "passport",
     * "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified using the
     * accompanying EncryptedCredentials.
     * @var PassportFile
     */
    public $front_side;

    /**
     * Optional. Encrypted file with the reverse side of the document, provided by the user. Available for
     * "driver_license" and "identity_card". The file can be decrypted and verified using the accompanying
     * EncryptedCredentials.
     * @var PassportFile
     */
    public $reverse_side;

    /**
     * Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for
     * "passport", "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified
     * using the accompanying EncryptedCredentials.
     * @var PassportFile
     */
    public $selfie;

    public function getMandatoryFields(): array
    {
        return [
            'type',
        ];
    }
}

<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\Symmetric;

use ParagonIE\ConstantTime\Binary;
use ParagonIE\HaliteLegacy\Alerts\InvalidKey;
use ParagonIE\HiddenString\HiddenString;

/**
 * Class EncryptionKey
 * @package ParagonIE\HaliteLegacy\Symmetric
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
final class EncryptionKey extends SecretKey
{
    /**
     * EncryptionKey constructor.
     * @param HiddenString $keyMaterial - The actual key data
     * @throws InvalidKey
     * @throws \TypeError
     */
    public function __construct(HiddenString $keyMaterial)
    {
        if (Binary::safeStrlen($keyMaterial->getString()) !== \SODIUM_CRYPTO_STREAM_KEYBYTES) {
            throw new InvalidKey(
                'Encryption key must be CRYPTO_STREAM_KEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
    }
}

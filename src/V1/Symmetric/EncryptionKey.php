<?php
namespace ParagonIE\HaliteLegacy\V1\Symmetric;

use \ParagonIE\HaliteLegacy\V1\Util as CryptoUtil;
use \ParagonIE\HaliteLegacy\V1\Alerts as CryptoException;

final class EncryptionKey extends SecretKey
{
    /**
     * @param string $keyMaterial - The actual key data
     */
    public function __construct($keyMaterial = '', ...$args)
    {
        // Longer keys are OK here; it gets blended through HKDF anyway.
        // We're only blocking weak keys here.
        if (CryptoUtil::safeStrlen($keyMaterial) < \Sodium\CRYPTO_STREAM_KEYBYTES) {
            throw new CryptoException\InvalidKey(
                'Encryption key must be at least CRYPTO_STREAM_KEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial, false);
    }
}

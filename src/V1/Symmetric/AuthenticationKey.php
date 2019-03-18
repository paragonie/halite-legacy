<?php
namespace ParagonIE\HaliteLegacy\V1\Symmetric;

use \ParagonIE\HaliteLegacy\V1\Util as CryptoUtil;
use \ParagonIE\HaliteLegacy\V1\Alerts as CryptoException;

final class AuthenticationKey extends SecretKey
{
    /**
     * @param string $keyMaterial - The actual key data
     */
    public function __construct($keyMaterial = '', ...$args)
    {
        // HMAC-SHA512/256 keys are a fixed size
        if (CryptoUtil::safeStrlen($keyMaterial) !== \Sodium\CRYPTO_AUTH_KEYBYTES) {
            throw new CryptoException\InvalidKey(
                'Authentication key must be CRYPTO_AUTH_KEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial, true);
    }
}

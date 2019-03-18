<?php
namespace ParagonIE\HaliteLegacy\V1\Asymmetric;

use \ParagonIE\HaliteLegacy\V1\Util as CryptoUtil;
use \ParagonIE\HaliteLegacy\V1\Alerts as CryptoException;

final class SignaturePublicKey extends PublicKey
{
    /**
     * @param string $keyMaterial - The actual key data
     * @param bool $signing - Is this a signing key?
     */
    public function __construct($keyMaterial = '', ...$args) 
    {
        // Ed25519 keys are a fixed size
        if (CryptoUtil::safeStrlen($keyMaterial) !== \Sodium\CRYPTO_SIGN_PUBLICKEYBYTES) {
            throw new CryptoException\InvalidKey(
                'Signature public key must be CRYPTO_SIGN_PUBLICKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial, true);
    }
}

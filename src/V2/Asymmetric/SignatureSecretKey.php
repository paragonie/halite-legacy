<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V2\Asymmetric;

use \ParagonIE\HaliteLegacy\V2\Alerts\InvalidKey;
use \ParagonIE\HaliteLegacy\V2\Util as CryptoUtil;

/**
 * Class SignatureSecretKey
 * @package ParagonIE\HaliteLegacy\V2\Asymmetric
 */
final class SignatureSecretKey extends SecretKey
{
    /**
     * @param string $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(string $keyMaterial = '')
    {
        if (CryptoUtil::safeStrlen($keyMaterial) !== \Sodium\CRYPTO_SIGN_SECRETKEYBYTES) {
            throw new InvalidKey(
                'Signature secret key must be CRYPTO_SIGN_SECRETKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
        $this->is_signing_key = true;
    }
    
    /**
     * See the appropriate derived class.
     * 
     * @return SignaturePublicKey
     */
    public function derivePublicKey()
    {
        $publicKey = \Sodium\crypto_sign_publickey_from_secretkey(
            $this->getRawKeyMaterial()
        );
        return new SignaturePublicKey($publicKey);
    }
}

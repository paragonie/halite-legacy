<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V3\Asymmetric;

use ParagonIE\HaliteLegacy\V3\Alerts\InvalidKey;
use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Util as CryptoUtil;

/**
 * Class SignatureSecretKey
 * @package ParagonIE\HaliteLegacy\V3\Asymmetric
 */
final class SignatureSecretKey extends SecretKey
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(HiddenString $keyMaterial)
    {
        if (CryptoUtil::safeStrlen($keyMaterial->getString()) !== \Sodium\CRYPTO_SIGN_SECRETKEYBYTES) {
            throw new InvalidKey(
                'Signature secret key must be CRYPTO_SIGN_SECRETKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
        $this->isSigningKey = true;
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
        return new SignaturePublicKey(new HiddenString($publicKey));
    }
}

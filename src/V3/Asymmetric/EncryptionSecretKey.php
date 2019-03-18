<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V3\Asymmetric;

use ParagonIE\HaliteLegacy\V3\Alerts\InvalidKey;
use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Util as CryptoUtil;

/**
 * Class EncryptionSecretKey
 * @package ParagonIE\HaliteLegacy\V3\Asymmetric
 */
final class EncryptionSecretKey extends SecretKey
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(HiddenString $keyMaterial)
    {
        if (CryptoUtil::safeStrlen($keyMaterial->getString()) !== \Sodium\CRYPTO_BOX_SECRETKEYBYTES) {
            throw new InvalidKey(
                'Encryption secret key must be CRYPTO_BOX_SECRETKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
    }
    
    /**
     * See the appropriate derived class.
     * 
     * @return EncryptionPublicKey
     */
    public function derivePublicKey()
    {
        $publicKey = \Sodium\crypto_box_publickey_from_secretkey(
            $this->getRawKeyMaterial()
        );
        return new EncryptionPublicKey(
            new HiddenString($publicKey)
        );
    }
}

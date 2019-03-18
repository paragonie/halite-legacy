<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V3\Asymmetric;

use ParagonIE\HaliteLegacy\V3\Alerts\InvalidKey;
use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Util as CryptoUtil;

/**
 * Class SignaturePublicKey
 * @package ParagonIE\HaliteLegacy\V3\Asymmetric
 */
final class SignaturePublicKey extends PublicKey
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(HiddenString $keyMaterial)
    {
        if (CryptoUtil::safeStrlen($keyMaterial->getString()) !== \Sodium\CRYPTO_SIGN_PUBLICKEYBYTES) {
            throw new InvalidKey(
                'Signature public key must be CRYPTO_SIGN_PUBLICKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
        $this->isSigningKey = true;
    }
}

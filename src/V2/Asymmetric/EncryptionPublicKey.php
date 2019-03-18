<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V2\Asymmetric;

use \ParagonIE\HaliteLegacy\V2\Alerts\InvalidKey;
use \ParagonIE\HaliteLegacy\V2\Util as CryptoUtil;

/**
 * Class EncryptionPublicKey
 * @package ParagonIE\HaliteLegacy\V2\Asymmetric
 */
final class EncryptionPublicKey extends PublicKey
{
    /**
     * @param string $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(string $keyMaterial = '')
    {
        if (CryptoUtil::safeStrlen($keyMaterial) !== \Sodium\CRYPTO_BOX_PUBLICKEYBYTES) {
            throw new InvalidKey(
                'Encryption public key must be CRYPTO_BOX_PUBLICKEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
    }
}

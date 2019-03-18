<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V3\Symmetric;

use ParagonIE\HaliteLegacy\V3\Alerts\InvalidKey;
use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Util as CryptoUtil;

/**
 * Class EncryptionKey
 * @package ParagonIE\HaliteLegacy\V3\Symmetric
 */
final class EncryptionKey extends SecretKey
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(HiddenString $keyMaterial)
    {
        if (CryptoUtil::safeStrlen($keyMaterial->getString()) !== \Sodium\CRYPTO_STREAM_KEYBYTES) {
            throw new InvalidKey(
                'Encryption key must be CRYPTO_STREAM_KEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
    }
}

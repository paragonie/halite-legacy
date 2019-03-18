<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V2\Symmetric;

use \ParagonIE\HaliteLegacy\V2\Alerts\InvalidKey;
use \ParagonIE\HaliteLegacy\V2\Util as CryptoUtil;

/**
 * Class EncryptionKey
 * @package ParagonIE\HaliteLegacy\V2\Symmetric
 */
final class EncryptionKey extends SecretKey
{
    /**
     * @param string $keyMaterial - The actual key data
     * @throws InvalidKey
     */
    public function __construct(string $keyMaterial = '')
    {
        if (CryptoUtil::safeStrlen($keyMaterial) !== \Sodium\CRYPTO_STREAM_KEYBYTES) {
            throw new InvalidKey(
                'Encryption key must be CRYPTO_STREAM_KEYBYTES bytes long'
            );
        }
        parent::__construct($keyMaterial);
    }
}

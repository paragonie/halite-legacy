<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V3\Asymmetric;

use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Key;

/**
 * Class PublicKey
 * @package ParagonIE\HaliteLegacy\V3\Asymmetric
 */
class PublicKey extends Key
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     */
    public function __construct(HiddenString $keyMaterial)
    {
        parent::__construct($keyMaterial);
        $this->isAsymmetricKey = true;
        $this->isPublicKey = true;
    }
}

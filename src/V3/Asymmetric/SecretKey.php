<?php
namespace ParagonIE\HaliteLegacy\V3\Asymmetric;

use ParagonIE\HaliteLegacy\V3\HiddenString;
use ParagonIE\HaliteLegacy\V3\Key;
use ParagonIE\HaliteLegacy\V3\Alerts\CannotPerformOperation;

/**
 * Class SecretKey
 * @package ParagonIE\HaliteLegacy\V3\Asymmetric
 */
class SecretKey extends Key
{
    /**
     * @param HiddenString $keyMaterial - The actual key data
     */
    public function __construct(HiddenString $keyMaterial)
    {
        parent::__construct($keyMaterial);
        $this->isAsymmetricKey = true;
    }
    
    /**
     * See the appropriate derived class.
     */
    public function derivePublicKey()
    {
        throw new CannotPerformOperation(
            'This is not implemented in the base class'
        );
    }
}

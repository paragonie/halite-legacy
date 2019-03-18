<?php
namespace ParagonIE\HaliteLegacy\V1\Asymmetric;

use \ParagonIE\HaliteLegacy\V1\Contract;
use \ParagonIE\HaliteLegacy\V1\Key;
use \ParagonIE\HaliteLegacy\V1\Alerts\CannotPerformOperation;

class SecretKey extends Key implements Contract\KeyInterface
{
    /**
     * @param string $keyMaterial - The actual key data
     * @param bool $signing - Is this a signing key?
     */
    public function __construct($keyMaterial = '', ...$args) 
    {
        /** @var bool $signing */
        $signing = \count($args) >= 1
            ? $args[0]
            : false;
        parent::__construct($keyMaterial, false, $signing, true);
    }
    
    /**
     * See the appropriate derived class.
     * @throws CannotPerformOperation
     * @return void
     */
    public function derivePublicKey()
    {
        throw new CannotPerformOperation(
            'This is not implemented in the base class'
        );
    }
}

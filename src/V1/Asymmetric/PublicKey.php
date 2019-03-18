<?php
namespace ParagonIE\HaliteLegacy\V1\Asymmetric;

use \ParagonIE\HaliteLegacy\V1\Contract;
use \ParagonIE\HaliteLegacy\V1\Key;

class PublicKey extends Key implements Contract\KeyInterface
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
        parent::__construct($keyMaterial, true, $signing, true);
    }
}

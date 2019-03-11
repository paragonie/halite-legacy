<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V2\Asymmetric;

use \ParagonIE\Halite\Contract;
use \ParagonIE\Halite\Key;

/**
 * Class PublicKey
 * @package ParagonIE\Halite\Asymmetric
 */
class PublicKey extends Key
{
    /**
     * @param string $keyMaterial - The actual key data
     */
    public function __construct(string $keyMaterial = '')
    {
        parent::__construct($keyMaterial);
        $this->is_asymmetric_key = true;
        $this->is_public_key = true;
    }
}

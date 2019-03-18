<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V2\Symmetric;

use \ParagonIE\HaliteLegacy\V2\Key;

/**
 * Class SecretKey
 * @package ParagonIE\HaliteLegacy\V2\Symmetric
 */
class SecretKey extends Key
{
    /**
     * @param string $keyMaterial - The actual key data
     */
    public function __construct(string $keyMaterial = '')
    {
        parent::__construct($keyMaterial);
    }
}

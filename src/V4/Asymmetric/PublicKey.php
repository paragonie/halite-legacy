<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\Asymmetric;

use ParagonIE\HaliteLegacy\Key;
use ParagonIE\HiddenString\HiddenString;

/**
 * Class PublicKey
 * @package ParagonIE\HaliteLegacy\Asymmetric
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
class PublicKey extends Key
{
    /**
     * PublicKey constructor.
     * @param HiddenString $keyMaterial - The actual key data
     *
     * @throws \TypeError
     */
    public function __construct(HiddenString $keyMaterial)
    {
        parent::__construct($keyMaterial);
        $this->isAsymmetricKey = true;
        $this->isPublicKey = true;
    }
}

<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy;

use ParagonIE\ConstantTime\Binary;
use ParagonIE\HaliteLegacy\V1\Halite as HaliteV1;
use ParagonIE\HaliteLegacy\V2\Halite as HaliteV2;
use ParagonIE\HaliteLegacy\V3\Halite as HaliteV3;
use ParagonIE\HaliteLegacy\V4\Halite as HaliteV4;

final class VersionHelper
{
    const LATEST = 5;

    /**
     * @param string $data
     * @return int
     * @throws InvalidVersionException
     */
    public static function inferVersionFromCiphertext(string $data): int
    {
        $header = Binary::safeSubstr($data, 0, 4);
        // Version 1
        if (hash_equals(HaliteV1::HALITE_VERSION, $header)) {
            return 1;
        }
        if (hash_equals(HaliteV1::HALITE_VERSION_FILE, $header)) {
            return 1;
        }
        if (hash_equals(HaliteV1::HALITE_VERSION_KEYS, $header)) {
            return 1;
        }

        // Version 2
        if (hash_equals(HaliteV2::HALITE_VERSION, $header)) {
            return 2;
        }
        if (hash_equals(HaliteV2::HALITE_VERSION_FILE, $header)) {
            return 2;
        }
        if (hash_equals(HaliteV2::HALITE_VERSION_KEYS, $header)) {
            return 2;
        }

        // Version 3
        if (hash_equals(HaliteV3::HALITE_VERSION, $header)) {
            return 3;
        }
        if (hash_equals(HaliteV3::HALITE_VERSION_FILE, $header)) {
            return 3;
        }
        if (hash_equals(HaliteV3::HALITE_VERSION_KEYS, $header)) {
            return 3;
        }

        // Version 4
        if (hash_equals(HaliteV4::HALITE_VERSION, $header)) {
            return 4;
        }
        if (hash_equals(HaliteV4::HALITE_VERSION_FILE, $header)) {
            return 4;
        }
        if (hash_equals(HaliteV4::HALITE_VERSION_KEYS, $header)) {
            return 4;
        }

        throw new InvalidVersionException('Could not infer version from ciphertext');
    }
}

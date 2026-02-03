<?php
declare(strict_types=1);
namespace ParagonIE\HaliteLegacy\V4\Stream;

/**
 * Class WeakReadOnlyFile
 *
 * Like ReadOnlyFile, but with weaker guarantees
 *
 * @package ParagonIE\HaliteLegacy\V4\Stream
 */
class WeakReadOnlyFile extends ReadOnlyFile
{
    const ALLOWED_MODES = ['rb', 'r+b', 'wb', 'w+b', 'cb', 'c+b'];
}

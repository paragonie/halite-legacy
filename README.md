# Halite-Legacy

See [Halite](https://github.com/paragonie/halite) for documentation, etc.

This library allows you to side-load an unsupported legacy version of Halite
into your application in order to migrate data to the newest version.

> ### Important
> 
> **This library is out of scope for any bug bounty programs!**
>
> Please refer to Halite for a library that is in-scope.

## Installing

Use Composer.

```
composer require paragonie/halite-legacy
```

### Migrating Code

Simply use the legacy classes to facilitate decryption, and re-encrypt with
the latest version of Halite.

```php
<?php
use ParagonIE\Halite\Symmetric\{
    Crypto,
    EncryptionKey    
};
use ParagonIE\HaliteLegacy\V3\Symmetric\{
    Crypto as LegacyCrypto,
    EncryptionKey as LegacyKey
};
use ParagonIE\HaliteLegacy\V3\HiddenString as LegacyHiddenString;
use ParagonIE\HiddenString\HiddenString;

/**
 * @var EncryptionKey $encKey
 * @var LegacyKey $oldKey
 * @var string $ciphertext
 * @var LegacyHiddenString $plaintext
 */
$plaintext = LegacyCrypto::decrypt($ciphertext, $oldKey);
$storeMe = Crypto::encrypt(
    new HiddenString($plaintext->getString()),
    $encKey
);
```

## How To Perform A Migration

It is essential when migrating from an old version of Halite to do a two-putt migration. This is the Platonic ideal; the
minimal number of steps necessary to prevent a "split brain" scenario in a distributed system.

First, update your code to use HaliteLegacy to read the old ciphertext formats. (See [migrating code](#migrating-code)
above). It is imperative that you test and rollout this change first before proceeding to the next step.

Next, update your code to start writing the new ciphertext format using Halite proper. 

We provide a class called `VersionHelper` for inferring the version of a ciphertext from an encrypted message.
You can use it like so:

```php
<?php
use ParagonIE\HaliteLegacy\VersionHelper;
use ParagonIE\Halite\Symmetric\Crypto as SymmetricLatest;
use ParagonIE\HaliteLegacy\V4\Symmetric\Crypto as SymmetricV4;

// Version will be an integer, or it will throw
$inferredVersion = VersionHelper::inferVersionFromCiphertext($ciphertext);

if ($inferredVersion === VersionHelper::LATEST) {
    // If it's the latest, use Halite:
    $plaintext = SymmetricLatest::decrypt($ciphertext, $secretKey);
} elseif ($inferredVersion === 4) {
    // If it's an explicitly-supported legacy version, decrypt it
    $plaintext = SymmetricV4::decrypt($ciphertext, $secretKey);
    
    // Recommended: Re-encrypt with the latest version:
    $reEncrypted = SymmetricLatest::encrypt($plaintext, $secretKey);
} else {
    throw new Exception('We never supported v3 ciphertexts. Abort!');
}
```

### What If You Attempt A Migration Out Of Order?

Let's say you have 100 servers that handle ciphertext encrypted with Halite v4. (An arbitrary number.) 

If you don't follow the two-putt migration strategy we outlined above, rolling out an update to Halite v5 will create 
the risk of a split-brain scenario where some servers were updated and start emitting v5 ciphertexts before stale 
servers can decrypt them successfully.

By performing the migration the way we recommend, you guarantee **all your servers can read v5** before *any* begin 
writing messages using v5.

## Support Contracts

If your company uses this library in their products or services, you may be
interested in [purchasing a support contract from Paragon Initiative Enterprises](https://paragonie.com/enterprise).

Unpaid support will not be provided for `halite-legacy`.

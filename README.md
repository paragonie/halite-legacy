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
composer require paragonie/halite:^4
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

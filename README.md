# Uuid normalizer

[![Build Status](https://travis-ci.org/gbprod/uuid-normalizer.svg?branch=master)](https://travis-ci.org/gbprod/uuid-normalizer)
[![codecov](https://codecov.io/gh/gbprod/uuid-normalizer/branch/master/graph/badge.svg)](https://codecov.io/gh/gbprod/uuid-normalizer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/574a9caace8d0e004130d3aa/badge.svg)](https://www.versioneye.com/user/projects/574a9caace8d0e004130d3aa)

[![Latest Stable Version](https://poser.pugx.org/gbprod/uuid-normalizer/v/stable)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![Total Downloads](https://poser.pugx.org/gbprod/uuid-normalizer/downloads)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![Latest Unstable Version](https://poser.pugx.org/gbprod/uuid-normalizer/v/unstable)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![License](https://poser.pugx.org/gbprod/uuid-normalizer/license)](https://packagist.org/packages/gbprod/uuid-normalizer)

Normalizer to serialize [Ramsey Uuid](https://github.com/ramsey/uuid) using [Symfony Serializer](https://github.com/symfony/serializer).

## Installation

```bash
composer require gbprod/uuid-normalizer
```

## Why

By default, [Symfony Serializer](https://github.com/symfony/serializer) can't handle serialization and deserialization of [Ramsey Uuid](https://github.com/ramsey/uuid).
You will have that kind of errors:

```
Not a time-based UUID
500 Internal Server Error - UnsupportedOperationException
```

### Setup

In your `app/config/service.yml` file:

```yaml
services:
  uuid_normalizer:
    class: GBProd\UuidNormalizer\UuidNormalizer
    tags:
      - { name: serializer.normalizer }

  uuid_denormalizer:
    class: GBProd\UuidNormalizer\UuidDenormalizer
    tags:
      - { name: serializer.normalizer }
```

Or using `xml`:

```xml
<services>
    <service id="uuid_normalizer" class="GBProd\UuidNormalizer\UuidNormalizer">
        <tag name="serializer.normalizer" />
    </service>
    <service id="uuid_denormalizer" class="GBProd\UuidNormalizer\UuidDenormalizer">
        <tag name="serializer.normalizer" />
    </service>
</services>
```

Or `php`:

```php
use Symfony\Component\DependencyInjection\Definition;

$definition = new Definition('GBProd\UuidNormalizer\UuidNormalizer');
$definition->addTag('serializer.normalizer');
$container->setDefinition('uuid_normalizer', $definition);

$definition = new Definition('GBProd\UuidNormalizer\UuidDenormalizer');
$definition->addTag('serializer.normalizer');
$container->setDefinition('uuid_denormalizer', $definition);
```

Or building your own serializer:

```php
use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;

$serializer = new Serializer([
    new UuidNormalizer(),
    new UuidDenormalizer(),
    // Other normalizers...
]);
```

## Requirements

- PHP 7.2+

## Contributing

Feel free to contribute, see [CONTRIBUTING.md](CONTRIBUTING.md) file for more informations.

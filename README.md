# Uuid normalizer

[![Build Status](https://travis-ci.org/gbprod/uuid-normalizer.svg?branch=master)](https://travis-ci.org/gbprod/uuid-normalizer) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/?branch=master) 
[![Code Coverage](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gbprod/uuid-normalizer/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/gbprod/uuid-normalizer/v/stable)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![Total Downloads](https://poser.pugx.org/gbprod/uuid-normalizer/downloads)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![Latest Unstable Version](https://poser.pugx.org/gbprod/uuid-normalizer/v/unstable)](https://packagist.org/packages/gbprod/uuid-normalizer)
[![License](https://poser.pugx.org/gbprod/uuid-normalizer/license)](https://packagist.org/packages/gbprod/uuid-normalizer)


Normalizer to serialize [Ramsey Uuid](https://github.com/ramsey/uuid) with [Symfony Serializer](https://github.com/symfony/serializer).

## Installation

### With Composer

```bash
composer require gbprod/uuid-normalizer
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
            - { name: serializer.denormalizer }
```

## Why

By default, [Symfony Serializer](https://github.com/symfony/serializer) can't handle serialization and deserialization of [Ramsey Uuid](https://github.com/ramsey/uuid).
You will have that kind of errors: 

> Not a time-based UUID  
> 500 Internal Server Error - UnsupportedOperationException


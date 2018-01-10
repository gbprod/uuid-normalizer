<?php

namespace Tests\GBProd\UuidNormalizer;

use GBProd\UuidNormalizer\UuidDenormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * Tests for UuidDenormalizer
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidDenormalizerTest extends TestCase
{
    const UUID_SAMPLE = '110e8400-e29b-11d4-a716-446655440000';

    private $denormalizer;

    public function setUp()
    {
        $this->denormalizer = new UuidDenormalizer();
    }

    public function testSupportsIsFalseIfNotUuidClass()
    {
        $this->assertFalse(
            $this->denormalizer->supportsDenormalization(
                self::UUID_SAMPLE,
                'stdClass'
            )
        );
    }

    public function testSupportsIsFalseIfNotWellFormatted()
    {
        $this->assertFalse(
            $this->denormalizer->supportsDenormalization(
                'BAD_UUID',
                Uuid::class
            )
        );
    }

    public function testSupportsIsTrueIfRealUuid()
    {
        $this->assertTrue(
            $this->denormalizer->supportsDenormalization(
                self::UUID_SAMPLE,
                Uuid::class
            )
        );
    }

    public function testSupportsIsFalseIfBadType()
    {
        $this->assertFalse(
            $this->denormalizer->supportsDenormalization(
                42,
                Uuid::class
            )
        );
    }

    public function testSupportsIsTrueIfNull()
    {
        $this->assertTrue(
            $this->denormalizer->supportsDenormalization(
                null,
                Uuid::class
            )
        );
    }

    public function testDenormalize()
    {
        $uuid = Uuid::fromString(self::UUID_SAMPLE);

        $this->assertTrue(
            $uuid->equals(
                $this->denormalizer->denormalize(self::UUID_SAMPLE, Uuid::class)
            )
        );
    }
    public function testDenormalizeNull()
    {
        $this->assertNull(
            $this->denormalizer->denormalize(null, Uuid::class)
        );
    }
}

<?php

declare(strict_types=1);

namespace Tests\GBProd\UuidNormalizer;

use GBProd\UuidNormalizer\UuidDenormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Tests for UuidDenormalizer
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidDenormalizerTest extends TestCase
{
    const UUID_SAMPLE = '110e8400-e29b-11d4-a716-446655440000';

    /** @var UuidDenormalizer */
    private $denormalizer;

    public function setUp(): void
    {
        $this->denormalizer = new UuidDenormalizer();
    }

    public function testSupportsIsFalseIfNotUuidClass(): void
    {
        $this->assertFalse(
            $this->denormalizer->supportsDenormalization(
                self::UUID_SAMPLE,
                'stdClass'
            )
        );
    }

    public function testThrowExceptionIfNotWellFormatted(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->denormalizer->denormalize(
            'BAD_UUID',
            Uuid::class
        );
    }

    public function testSupportsIsTrueIfRealUuid(): void
    {
        $this->assertTrue(
            $this->denormalizer->supportsDenormalization(
                self::UUID_SAMPLE,
                Uuid::class
            )
        );
    }

    public function testSupportsIsTrueIfTypeIsUuidInterface(): void
    {
        $this->assertTrue(
            $this->denormalizer->supportsDenormalization(
                self::UUID_SAMPLE,
                UuidInterface::class
            )
        );
    }

    public function testSupportsIsTrueIfNull(): void
    {
        $this->assertTrue(
            $this->denormalizer->supportsDenormalization(
                null,
                Uuid::class
            )
        );
    }

    public function testDenormalize(): void
    {
        $uuid = Uuid::fromString(self::UUID_SAMPLE);

        $this->assertTrue(
            $uuid->equals(
                $this->denormalizer->denormalize(self::UUID_SAMPLE, Uuid::class)
            )
        );
    }
    public function testDenormalizeNull(): void
    {
        $this->assertNull(
            $this->denormalizer->denormalize(null, Uuid::class)
        );
    }
}

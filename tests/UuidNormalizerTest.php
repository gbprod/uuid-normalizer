<?php

declare(strict_types=1);

namespace Tests\GBProd\UuidNormalizer;

use GBProd\UuidNormalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Tests for UuidNormalizer
 *
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidNormalizerTest extends TestCase
{
    const UUID_SAMPLE = '110e8400-e29b-11d4-a716-446655440000';

    /** @var UuidNormalizer */
    private $normalizer;

    public function setUp(): void
    {
        $this->normalizer = new UuidNormalizer();
    }

    public function testSupportsIsFalseIfNotUuid(): void
    {
        $this->assertFalse(
            $this->normalizer->supportsNormalization(new \stdClass())
        );
    }

    /**
     * @dataProvider uuidProvider
     */
    public function testSupportsIsTrueIfUuid(UuidInterface $uuid): void
    {
        $this->assertTrue(
            $this->normalizer->supportsNormalization($uuid)
        );
    }

    /**
     * @return array<array<UuidInterface>>
     */
    public function uuidProvider(): array
    {
        return array(
            array(Uuid::uuid1()),
            array(Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net')),
            array(Uuid::uuid4()),
            array(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net')),
            array(Uuid::fromString(self::UUID_SAMPLE)),
        );
    }

    public function testNormalize(): void
    {
        $uuid = Uuid::fromString(self::UUID_SAMPLE);

        $this->assertEquals(
            self::UUID_SAMPLE,
            $this->normalizer->normalize($uuid)
        );
    }
}

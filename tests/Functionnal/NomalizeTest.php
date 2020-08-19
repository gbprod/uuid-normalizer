<?php

declare(strict_types=1);

namespace Tests\GBProd\UuidNormalizer\Functionnal;

use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NormalizeTest extends TestCase
{
    /** @var Serializer */
    private $serializer;

    public function setUp(): void
    {
        $this->serializer = new Serializer([
            new UuidNormalizer(),
            new UuidDenormalizer(),
            new ObjectNormalizer(),
        ], []);
    }

    public function testNormalizeOnArray(): void
    {
        $uuid = Uuid::uuid4();

        $normalized = (array) $this->serializer->normalize(
            ['uuid' => $uuid]
        );

        $this->assertEquals(
            $uuid->toString(),
            $normalized['uuid']
        );
    }

    public function testNormalizeOnObject(): void
    {
        $object = new ClassWithUuid();
        $object->uuid = Uuid::uuid4();

        $normalized = (array) $this->serializer->normalize($object);

        $this->assertEquals(
            $object->uuid->toString(),
            $normalized['uuid']
        );
    }

    public function testNormalizeArrayOfUuidOnObject(): void
    {
        $object = new ClassWithUuid();
        $object->uuid = [
            Uuid::uuid4(),
            Uuid::uuid4(),
            Uuid::uuid4(),
        ];

        $normalized = (array) $this->serializer->normalize($object);

        $this->assertEquals(
            $object->uuid[0]->toString(),
            $normalized['uuid'][0]
        );
    }
}

class ClassWithUuid
{
    /** @var UuidInterface|array<UuidInterface> */
    public $uuid;
}

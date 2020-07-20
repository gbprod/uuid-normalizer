<?php

namespace Tests\GBProd\UuidNormalizer\Functionnal;

use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NormalizeTest extends TestCase
{
    private $serializer;

    public function setUp()
    {
        $this->serializer = new Serializer([
            new UuidNormalizer(),
            new UuidDenormalizer(),
            new ObjectNormalizer(),
        ], []);
    }

    public function testNormalizeOnArray()
    {
        $uuid = Uuid::uuid4();

        $normalized = $this->serializer->normalize(
            ['uuid' => $uuid]
        );

        $this->assertEquals(
            $uuid->toString(),
            $normalized['uuid']
        );
    }

    public function testNormalizeOnObject()
    {
        $object = new ClassWithUuid();
        $object->uuid = Uuid::uuid4();

        $normalized = $this->serializer->normalize($object);

        $this->assertEquals(
            $object->uuid->toString(),
            $normalized['uuid']
        );
    }

    public function testNormalizeArrayOfUuidOnObject()
    {
        $object = new ClassWithUuid();
        $object->uuid = [
            Uuid::uuid4(),
            Uuid::uuid4(),
            Uuid::uuid4(),
        ];

        $normalized = $this->serializer->normalize($object);

        $this->assertEquals(
            $object->uuid[0]->toString(),
            $normalized['uuid'][0]
        );
    }
}

class ClassWithUuid
{
    public $uuid;
}

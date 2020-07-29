<?php

declare(strict_types=1);

namespace Tests\GBProd\UuidNormalizer;

use GBProd\UuidNormalizer\UuidDenormalizer;
use GBProd\UuidNormalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DenormalizeUsingPhpDocTest extends TestCase
{
    private $serializer;

    public function setUp(): void
    {
        $this->serializer = new Serializer([
            new UuidNormalizer(),
            new UuidDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                new PhpDocExtractor()
            ),
            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    }

    public function testDenormalizeWithUuid(): void
    {
        $uuid = Uuid::uuid4();
        $denormalized = $this->serializer->denormalize(
            ['uuid' => $uuid->toString()],
            ClassWithUuidAttribute::class
        );

        $this->assertEquals($uuid, $denormalized->uuid);
    }

    public function testDenormalizeWithUuidInterface(): void
    {
        $uuid = Uuid::uuid4();
        $denormalized = $this->serializer->denormalize(
            ['uuid' => $uuid->toString()],
            ClassWithUuidInterfaceAttribute::class
        );

        $this->assertEquals($uuid, $denormalized->uuid);
    }

    public function testDenormalizeWithArrayOfUuid(): void
    {
        $uuids = [
            Uuid::uuid1(),
            Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net'),
            Uuid::uuid4(),
            Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net'),
        ];

        $denormalized = $this->serializer->denormalize(
            ['uuids' => array_map(function ($uuid) {
                return $uuid->toString();
            }, $uuids)],
            ClassWithArrayOfUuidAttribute::class
        );

        $this->assertEquals($uuids, $denormalized->uuids);
    }

    public function testDenormalizeWithArrayOfUuidInterface(): void
    {
        $uuids = [
            Uuid::uuid1(),
            Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net'),
            Uuid::uuid4(),
            Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net'),
        ];

        $denormalized = $this->serializer->denormalize(
            ['uuids' => array_map(function ($uuid) {
                return $uuid->toString();
            }, $uuids)],
            ClassWithArrayOfUuidInterfaceAttribute::class
        );

        $this->assertEquals($uuids, $denormalized->uuids);
    }
}

class ClassWithUuidAttribute
{
    /** @var Uuid */
    public $uuid;
}

class ClassWithUuidInterfaceAttribute
{
    /** @var UuidInterface */
    public $uuid;
}


class ClassWithArrayOfUuidAttribute
{
    /** @var Uuid[] */
    public $uuids;
}

class ClassWithArrayOfUuidInterfaceAttribute
{
    /** @var UuidInterface[] */
    public $uuids;
}

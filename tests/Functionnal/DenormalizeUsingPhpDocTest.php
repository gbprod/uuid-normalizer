<?php

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

    public function setUp()
    {
        $normalizers = [
            new UuidNormalizer(),
            new UuidDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                class_exists('Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor') ? new PhpDocExtractor() : null
            )
        ];

        if (class_exists('Symfony\Component\Serializer\Normalizer\ArrayDenormalizer')) {
            $normalizers[] = new ArrayDenormalizer();
        }

        $this->serializer = new Serializer($normalizers, [
            new JsonEncoder(),
        ]);
    }

    public function testDenormalizeWithUuid()
    {
        $uuid = Uuid::uuid4();
        $denormalized = $this->serializer->denormalize(
            ['uuid' => $uuid->toString()],
            ClassWithUuidAttribute::class
        );

        $this->assertEquals($uuid, $denormalized->uuid);
    }

    public function testDenormalizeWithUuidInterface()
    {
        $uuid = Uuid::uuid4();
        $denormalized = $this->serializer->denormalize(
            ['uuid' => $uuid->toString()],
            ClassWithUuidInterfaceAttribute::class
        );

        $this->assertEquals($uuid, $denormalized->uuid);
    }

    public function testDenormalizeWithArrayOfUuid()
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

    public function testDenormalizeWithArrayOfUuidInterface()
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

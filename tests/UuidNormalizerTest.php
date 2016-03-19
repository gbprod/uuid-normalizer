<?php

namespace Tests\GBProd\UuidNormalizer;

use GBProd\UuidNormalizer\UuidNormalizer;
use Ramsey\Uuid\Uuid;

/**
 * Tests for UuidNormalizer
 * 
 * @author gbprod <contact@gb-prod.fr>
 */
class UuidNormalizerTest extends \PHPUnit_Framework_TestCase
{
    const UUID_SAMPLE = '110e8400-e29b-11d4-a716-446655440000';
    
    private $normalizer;
    
    public function setUp()
    {
        $this->normalizer = new UuidNormalizer();
    }
    public function testSupportsIsFalseIfNotUuid()
    {
        $this->assertFalse(
            $this->normalizer->supportsNormalization(new \stdClass())
        );
    }
    
    /**
     * @dataProvider uuidProvider
     */
    public function testSupportsIsTrueIfUuid($uuid)
    {
        $this->assertTrue(
            $this->normalizer->supportsNormalization($uuid)
        );
    }

    public function uuidProvider()
    {
        return array(
            array(Uuid::uuid1()),
            array(Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net')),
            array(Uuid::uuid4()),
            array(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net')),   
            array(Uuid::fromString(self::UUID_SAMPLE)),   
        );
    }
    
    public function testNormalize()
    {
        $uuid = Uuid::fromString(self::UUID_SAMPLE);
        
        $this->assertEquals(
            self::UUID_SAMPLE,
            $this->normalizer->normalize($uuid)
        );
    }
}
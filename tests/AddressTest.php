<?php
/**
 * Created for LeadVertex
 * Date: 1/17/22 6:24 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Components\Address;

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{

    private string $postcode;
    private string $country;
    private string $region;
    private string $city;
    private string $address_1;
    private string $address_2;
    private Location $location;

    private Address $address;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postcode = '127427';
        $this->country = 'Russia';
        $this->region = 'Moscow';
        $this->city = 'Moscow';
        $this->address_1 = 'Academika Koroleva street, 12';
        $this->address_2 = 'office 2';
        $this->location = new Location(55.82290159033269, 37.60623969325991);

        $this->address = new Address(
            $this->country,
            $this->region,
            $this->city,
            $this->address_1,
            $this->address_2,
            $this->postcode,
            $this->location
        );
    }

    public function testGetSetPostcode(): void
    {
        $this->assertSame($this->postcode, $this->address->getPostcode());
        $value = '';
        $updated = $this->address->setPostcode($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getPostcode());
        $this->assertSame($this->postcode, $this->address->getPostcode());
    }

    public function testGetSetCountry(): void
    {
        $this->assertSame($this->country, $this->address->getCountry());
        $value = '';
        $updated = $this->address->setCountry($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getCountry());
        $this->assertSame($this->country, $this->address->getCountry());
    }

    public function testGetSetRegion(): void
    {
        $this->assertSame($this->region, $this->address->getRegion());
        $value = '';
        $updated = $this->address->setRegion($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getRegion());
        $this->assertSame($this->region, $this->address->getRegion());
    }

    public function testGetSetCity(): void
    {
        $this->assertSame($this->city, $this->address->getCity());
        $value = '';
        $updated = $this->address->setCity($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getCity());
        $this->assertSame($this->city, $this->address->getCity());
    }

    public function testGetSetAddress_1(): void
    {
        $this->assertSame($this->address_1, $this->address->getAddress_1());
        $value = '';
        $updated = $this->address->setAddress_1($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getAddress_1());
        $this->assertSame($this->address_1, $this->address->getAddress_1());
    }

    public function testGetSetAddress_2(): void
    {
        $this->assertSame($this->address_2, $this->address->getAddress_2());
        $value = '';
        $updated = $this->address->setAddress_2($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getAddress_2());
        $this->assertSame($this->address_2, $this->address->getAddress_2());
    }

    public function testGetSetLocation(): void
    {
        $this->assertSame($this->location, $this->address->getLocation());
        $value = null;
        $updated = $this->address->setLocation($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getLocation());
        $this->assertSame($this->location, $this->address->getLocation());
    }

    public function testJsonSerialize(): void
    {

        $this->assertSame(json_encode([
            'postcode' => $this->postcode,
            'country' => $this->country,
            'region' => $this->region,
            'city' => $this->city,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'location' => [
                'longitude' => $this->location->getLongitude(),
                'latitude' => $this->location->getLatitude(),
            ]
        ]), json_encode($this->address));
    }

    public function testToString(): void
    {
        $this->assertSame(
            '127427, Russia, Moscow, Moscow, Academika Koroleva street, 12, office 2',
            (string) $this->address
        );
    }


}

<?php
/**
 * Created for LeadVertex
 * Date: 1/17/22 6:24 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace SalesRender\Components\Address;

use SalesRender\Components\Address\Exceptions\InvalidAddressCountryException;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{

    private string $postcode;
    private string $region;
    private string $city;
    private string $address_1;
    private string $address_2;
    private string $building;
    private string $apartment;
    private string $countryCode;
    private Location $location;

    private Address $address;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postcode = '127427';
        $this->countryCode = 'RU';
        $this->region = 'Moscow';
        $this->city = 'Moscow';
        $this->address_1 = 'Academika Koroleva street, 12';
        $this->address_2 = 'office 2';
        $this->building = '3/1';
        $this->apartment = '555';
        $this->location = new Location(55.82290159033269, 37.60623969325991);

        $this->address = new Address(
            $this->region,
            $this->city,
            $this->address_1,
            $this->address_2,
            $this->building,
            $this->apartment,
            $this->postcode,
            $this->countryCode,
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
        $this->assertSame($this->countryCode, $this->address->getCountryCode());
        $value = null;
        $updated = $this->address->setCountryCode($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getCountryCode());
        $this->assertSame($this->countryCode, $this->address->getCountryCode());

        $this->expectException(InvalidAddressCountryException::class);
        $this->address->setCountryCode('QWERTY');
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

    public function testGetSetBuilding(): void
    {
        $this->assertSame($this->building, $this->address->getBuilding());
        $value = '';
        $updated = $this->address->setBuilding($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getBuilding());
        $this->assertSame($this->building, $this->address->getBuilding());
    }

    public function testGetSetApartment(): void
    {
        $this->assertSame($this->apartment, $this->address->getApartment());
        $value = '';
        $updated = $this->address->setApartment($value);
        $this->assertNotSame($this->address, $updated);
        $this->assertSame($value, $updated->getApartment());
        $this->assertSame($this->apartment, $this->address->getApartment());
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
            'region' => $this->region,
            'city' => $this->city,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'building' => $this->building,
            'apartment' => $this->apartment,
            'countryCode' => $this->countryCode,
            'location' => [
                'latitude' => $this->location->getLatitude(),
                'longitude' => $this->location->getLongitude(),
            ]
        ]), json_encode($this->address));
    }

    public function testToString(): void
    {
        $this->assertSame(
            'RU, 127427, Moscow, Moscow, Academika Koroleva street, 12, office 2, 3/1, 555',
            (string) $this->address
        );
    }


}

<?php
/**
 * Created for LeadVertex
 * Date: 1/17/22 6:25 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace SalesRender\Components\Address;

use SalesRender\Components\Address\Exceptions\InvalidLocationLatitudeException;
use SalesRender\Components\Address\Exceptions\InvalidLocationLongitudeException;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{

    private Location $location;
    private float $latitude;
    private float $longitude;

    protected function setUp(): void
    {
        parent::setUp();
        $this->latitude = 37.60623969325991;
        $this->longitude = 55.82290159033269;
        $this->location = new Location($this->latitude, $this->longitude);
    }

    public function invalidDataProvider(): array
    {
        return [
            [-90.1, 45, InvalidLocationLatitudeException::class],
            [90.1, 45, InvalidLocationLatitudeException::class],
            [45, -180.1, InvalidLocationLongitudeException::class],
            [45, 180.1, InvalidLocationLongitudeException::class],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     * @param float $lat
     * @param float $lon
     * @param string $exception
     * @return void
     * @throws InvalidLocationLatitudeException
     * @throws InvalidLocationLongitudeException
     */
    public function testConstructWithInvalidData(float $lat, float $lon, string $exception): void
    {
        $this->expectException($exception);
        new Location($lat, $lon);
    }

    public function testGetLatitude(): void
    {
        $this->assertSame($this->latitude, $this->location->getLatitude());
    }

    public function testGetLongitude(): void
    {
        $this->assertSame($this->longitude, $this->location->getLongitude());
    }

    public function testJsonSerialize(): void
    {
        $this->assertSame(
            json_encode([
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]),
            json_encode($this->location)
        );
    }



}

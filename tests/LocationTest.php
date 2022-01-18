<?php
/**
 * Created for LeadVertex
 * Date: 1/17/22 6:25 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Components\Address;

use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{

    private Location $location;
    private float $longitude;
    private float $latitude;

    protected function setUp(): void
    {
        parent::setUp();
        $this->longitude = 55.82290159033269;
        $this->latitude = 37.60623969325991;
        $this->location = new Location($this->longitude, $this->latitude);
    }

    public function testGetLongitude(): void
    {
        $this->assertSame($this->longitude, $this->location->getLongitude());
    }

    public function testGetLatitude(): void
    {
        $this->assertSame($this->latitude, $this->location->getLatitude());
    }

    public function testJsonSerialize(): void
    {
        $this->assertSame(
            json_encode([
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ]),
            json_encode($this->location)
        );
    }



}

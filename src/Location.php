<?php
/**
 * Created for SalesRender
 * Date: 1/17/22 5:42 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace SalesRender\Components\Address;

use JsonSerializable;
use SalesRender\Components\Address\Exceptions\InvalidLocationLatitudeException;
use SalesRender\Components\Address\Exceptions\InvalidLocationLongitudeException;

class Location implements JsonSerializable
{

    private float $latitude;
    private float $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     * @throws InvalidLocationLatitudeException
     * @throws InvalidLocationLongitudeException
     */
    public function __construct(float $latitude, float $longitude)
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new InvalidLocationLatitudeException('Latitude value should be between -90 and 90');
        }

        if ($longitude < -180 || $longitude > 180) {
            throw new InvalidLocationLongitudeException('Longitude value should be between -180 and 180');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function jsonSerialize(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
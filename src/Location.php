<?php
/**
 * Created for LeadVertex 2.0.
 * Date: 1/17/22 5:42 PM
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Components\Address;

use JsonSerializable;

class Location implements JsonSerializable
{

    private float $longitude;
    private float $latitude;

    public function __construct(float $longitude, float $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function jsonSerialize(): array
    {
        return [
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
<?php
/**
 * Created for LeadVertex 2.0.
 * Datetime: 03.10.2018 14:44
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace Leadvertex\Components\Address;


use JsonSerializable;

class Address implements JsonSerializable
{

    private string $postcode = '';

    private string $country = '';

    private string $region = '';

    private string $city = '';

    private string $address_1 = '';

    private string $address_2 = '';

    private ?Location $location = null;

    public function __construct(
        string $country,
        string $region,
        string $city,
        string $address_1,
        string $address_2 = '',
        string $postcode = '',
        Location $location = null
    )
    {
        $this->postcode = $postcode;
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->address_1 = $address_1;
        $this->address_2 = $address_2;
        $this->location = $location;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $clone = clone $this;
        $clone->postcode = trim($postcode);
        return $clone;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $clone = clone $this;
        $clone->country = $country;
        return $clone;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $clone = clone $this;
        $clone->region = trim($region);
        return $clone;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $clone = clone $this;
        $clone->city = trim($city);
        return $clone;
    }

    public function getAddress_1(): string
    {
        return $this->address_1;
    }

    public function setAddress_1(string $address_1): self
    {
        $clone = clone $this;
        $clone->address_1 = trim($address_1);
        return $clone;
    }

    public function getAddress_2(): string
    {
        return $this->address_2;
    }


    public function setAddress_2(string $address_2): self
    {
        $clone = clone $this;
        $clone->address_2 = trim($address_2);
        return $clone;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $clone = clone $this;
        $clone->location = $location;
        return $clone;
    }

    public function __toString(): string
    {
        return implode(', ', [
            $this->postcode,
            $this->country,
            $this->region,
            $this->city,
            $this->address_1,
            $this->address_2
        ]);
    }

    public function jsonSerialize(): array
    {
        return [
            'postcode' => $this->postcode,
            'country' => $this->country,
            'region' => $this->region,
            'city' => $this->city,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'location' => $this->location
        ];
    }
}
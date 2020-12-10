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

    private string $region = '';

    private string $city = '';

    private string $address_1 = '';

    private string $address_2 = '';

    public function __construct(
        string $region,
        string $city,
        string $address_1,
        string $address_2 = '',
        string $postcode = ''
    )
    {
        $this->region = $region;
        $this->city = $city;
        $this->address_1 = $address_1;
        $this->address_2 = $address_2;
        $this->postcode = $postcode;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = trim($postcode);
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = trim($region);
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = trim($city);
    }

    public function getAddress_1(): string
    {
        return $this->address_1;
    }

    public function setAddress_1(string $address_1): void
    {
        $this->address_1 = trim($address_1);
    }

    public function getAddress_2(): string
    {
        return $this->address_2;
    }


    public function setAddress_2(string $address_2): void
    {
        $this->address_2 = trim($address_2);
    }

    public function __toString(): string
    {
        return implode(', ', [
            $this->postcode,
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
            'region' => $this->region,
            'city' => $this->city,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2
        ];
    }
}
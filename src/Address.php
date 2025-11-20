<?php
/**
 * Created for LeadVertex 2.0.
 * Datetime: 03.10.2018 14:44
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace SalesRender\Components\Address;

use JsonSerializable;
use SalesRender\Components\Address\Exceptions\InvalidAddressCountryException;
use Symfony\Component\Intl\Countries;

class Address implements JsonSerializable
{

    private string $postcode = '';

    private string $region = '';

    private string $city = '';

    private string $address_1 = '';

    private string $address_2 = '';

    private string $building = '';

    private string $apartment = '';

    private ?string $countryCode = null;

    private ?Location $location = null;

    private string $additional_1 = '';

    private string $additional_2 = '';

    private string $additional_3 = '';

    /**
     * @throws InvalidAddressCountryException
     */
    public function __construct(
        string   $region,
        string   $city,
        string   $address_1,
        string   $address_2 = '',
        string   $building = '',
        string   $apartment = '',
        string   $postcode = '',
        string   $countryCode = null,
        Location $location = null
    )
    {
        $this->postcode = $postcode;
        $this->region = $region;
        $this->city = $city;
        $this->address_1 = $address_1;
        $this->address_2 = $address_2;
        $this->building = $building;
        $this->apartment = $apartment;

        $this->guardCountryCode($countryCode);
        $this->countryCode = $countryCode;
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

    public function getBuilding(): string
    {
        return $this->building;
    }

    public function setBuilding(string $building): self
    {
        $clone = clone $this;
        $clone->building = trim($building);
        return $clone;
    }

    public function getApartment(): string
    {
        return $this->apartment;
    }

    public function setApartment(string $apartment): self
    {
        $clone = clone $this;
        $clone->apartment = trim($apartment);
        return $clone;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $code
     * @return $this
     * @throws InvalidAddressCountryException
     */
    public function setCountryCode(?string $code): self
    {
        if (!is_null($code)) {
            $code = strtoupper($code);
        }

        $this->guardCountryCode($code);
        $clone = clone $this;
        $clone->countryCode = $code;
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

    public function getAdditional_1(): string
    {
        return $this->additional_1;
    }

    public function setAdditional_1(string $additional_1): self
    {
        $clone = clone $this;
        $clone->additional_1 = $additional_1;
        return $clone;
    }

    public function getAdditional_2(): string
    {
        return $this->additional_2;
    }

    public function setAdditional_2(string $additional_2): self
    {
        $clone = clone $this;
        $clone->additional_2 = $additional_2;
        return $clone;
    }

    public function getAdditional_3(): string
    {
        return $this->additional_3;
    }

    public function setAdditional_3(string $additional_3): self
    {
        $clone = clone $this;
        $clone->additional_3 = $additional_3;
        return $clone;
    }

    public function __toString(): string
    {
        $fields = [
            $this->countryCode,
            $this->postcode,
            $this->region,
            $this->city,
            $this->address_1,
            $this->address_2,
            $this->building,
            $this->apartment,
            $this->additional_1,
            $this->additional_2,
            $this->additional_3,
        ];
        $nonEmptyFields = array_filter($fields);
        if (empty($nonEmptyFields)) {
            return '';
        }

        return implode(', ', $nonEmptyFields);
    }

    public function jsonSerialize(): array
    {
        return [
            'postcode' => $this->postcode,
            'region' => $this->region,
            'city' => $this->city,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'building' => $this->building,
            'apartment' => $this->apartment,
            'countryCode' => $this->countryCode,
            'location' => $this->location,
            'additional_1' => $this->additional_1,
            'additional_2' => $this->additional_2,
            'additional_3' => $this->additional_3,
        ];
    }

    /**
     * @param string|null $code
     * @return void
     * @throws InvalidAddressCountryException
     */
    private function guardCountryCode(?string $code): void
    {
        if ($code !== null && !Countries::exists($code)) {
            throw new InvalidAddressCountryException("Invalid country code '{$code}'. Country code should be in ISO 3166-1 alpha-2");
        }
    }
}
<?php
namespace App\Entity;

class AirportModel
{
    public string $name;
    public string $code;
    public string $country;
    public string $location;

    public function __construct(string $name, string $code, string $country, string $location){
        $this->name = $name;
        $this->code = $code;
        $this->country = $country;
        $this->location = $location;
    }

    public function getCode(): string { return $this->code; }

    public function getCountry(): string { return $this->country; }

    public function getName(): string { return $this->name; }

    public function getLocation(): string { return $this->location; }



    public function setCode(string $code): void { $this->code = $code; }

    public function setCountry(string $country): void { $this->country = $country; }

    public function setName(string $name): void { $this->name = $name; }

    public function setLocation(string $location): void { $this->location = $location; }
}
?>
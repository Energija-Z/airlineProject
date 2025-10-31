<?php
namespace App\Entity;

use App\Entity\AirportModel;

class AirlineModel
{
    private string $name;
    private string $country;
    public AirportModel $airports; // Plural, use list

    public function __construct(string $name, string $country, AirportModel $airports){
        $this->name = $name;
        $this->country = $country;
        $this->airports = $airports;
    }

    public function getAirports(): AirportModel { return $this->airports; }

    public function getCountry(): string { return $this->country; }

    public function getName(): string { return $this->name; }



    public function setAirports(AirportModel $airports): void { $this->airports = $airports; }

    public function setCountry(string $country): void { $this->country = $country; }

    public function setName(string $name): void { $this->name = $name; }
}
?>
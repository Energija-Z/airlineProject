<?php
namespace App\Entity;

use App\Entity\AirlineModel;
use App\Entity\AirportModel;

class RouteModel
{
    private AirlineModel $airline;
    private AirportModel $originAirport;
    private AirportModel $destinationAirport;

    public function __construct(AirlineModel $airline, AirportModel $originAirport, AirportModel $destinationAirport){
        $this->airline = $airline;
        $this->originAirport = $originAirport;
        $this->destinationAirport = $destinationAirport;
    }

    public function getAirline(): AirlineModel { return $this->airline; }

    public function getOriginAirport(): AirportModel { return $this->originAirport; }

    public function getDestinationAirport(): AirportModel { return $this->destinationAirport; }



    public function setAirline(AirlineModel $airline): void { $this->airline = $airline; }

    public function setOriginAirport(AirportModel $originAirport): void { $this->originAirport = $originAirport; }

    public function setDestinationAirport(AirportModel $destinationAirport): void { $this->destinationAirport = $destinationAirport; }
}
?>
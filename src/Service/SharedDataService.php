<?php
namespace App\Service;

use App\Entity\AirportModel;
use Symfony\Component\HttpFoundation\RequestStack;

class SharedDataService
{
    public function __construct(private RequestStack $requestStack)
    {
        //$session->set("abc", array());
    }

    public function init(){
        $session = $this->requestStack->getSession();
        $session->set("airportArray", []);
        $session->set("airlineArray", []);
        $session->set("routeArray", []);
    }

    public function setStorage(string $key, Object $value){
        $session = $this->requestStack->getSession();
        $sessionArray = $session->get($key);
        array_push(
            $sessionArray, $value
        );
        $session->set($key, $sessionArray);
    }

    public function setStorageAll(string $key, Array $value){
        $this->requestStack->getSession()->set($key, $value);
    }

    public function getStorage(string $key){
        return $this->requestStack->getSession()->get($key);
    }
}
?>
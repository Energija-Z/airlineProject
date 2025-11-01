<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\AirportModel;
use App\Entity\AirlineModel;
use App\Entity\RouteModel;
use App\Form\AirlineForm;
use App\Form\AirportForm;
use App\Form\RouteForm;
use App\Service\SharedDataService;

class HomeController extends AbstractController {

    #[Route("/")]
    public function indexRender(SharedDataService $sds) : Response {
        if(!$sds->getStorage("airportArray"))
            $sds->init();

        return $this->render("base.html.twig");
    }

    public function search($array, $searchValue){
        foreach($array as $i)
            if($i->getName() == $searchValue){
                return $i;
            }
        return -1;
    }

    #[Route("/airport", name: 'airport')]
    public function airportRender(SharedDataService $sds): Response
    {
        return $this->render('home/airport/airport.html.twig', [
            "airports" => $sds->getStorage("airportArray")
        ]);
    }

    #[Route("/airport/create")]
    public function airportAddRender(Request $request, SharedDataService $sds): Response
    {
        $form = $this->createForm(AirportForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $sds->setStorage("airportArray", new AirportModel(
                $formData["name"], $formData["code"], $formData["country"], $formData["location"]
            ));

            return $this->redirectToRoute('airport');
        }

        return $this->render('home/airport/airportAdd.html.twig', [
            'form' => $form
        ]);
    }

    #[Route("/airport/delete/{name}")]
    public function airportDeleteRender(string $name, Request $request, SharedDataService $sds): Response
    {
        $airportArray = $sds->getStorage("airportArray");
        for($i = 0; $i < sizeof($airportArray); $i++)
            if($airportArray[$i]->getName() === $name){
                unset($airportArray[$i]);
                $sds->setStorageAll("airportArray", $airportArray);
                break;
            }

        return $this->render('home/airport/airportDelete.html.twig', [
            "aiport" => $name
        ]);
    }

    #[Route("/airport/update")]
    public function airportUpdateRender(SharedDataService $sds): Response
    {
    }

    #[Route("/airline", name: 'airline')]
    public function airlineRender(SharedDataService $sds): Response
    {
        return $this->render('home/airline/airline.html.twig', [
            "airlines" => $sds->getStorage("airlineArray")
        ]);
    }

    #[Route("/airline/create", name: "airlineAdd")]
    public function airlineAddRender(Request $request, SharedDataService $sds): Response
    {
        $form = $this->createForm(AirlineForm::class);
        $form->handleRequest($request);
        $airportArray = $sds->getStorage("airportArray");

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $airports = $formData["airports"];

            // array_search did not work as intended
            $returnValue = $this->search($airportArray, $airports);
            if($returnValue != -1)
                $sds->setStorage("airlineArray", new AirlineModel(
                    $formData["name"], $formData["country"], $returnValue
                ));

            return $this->redirectToRoute('airline');
        }

        return $this->render('home/airline/airlineAdd.html.twig', [
            'form' => $form,
            "airports" => $airportArray
        ]);
    }

    #[Route("/airline/delete")]
    public function airlineDeleteRender(SharedDataService $sds): Response
    {

        $airlineArray = $sds->getStorage("airlineArray");
        for($i = 0; $i < sizeof($airlineArray); $i++)
            if($airlineArray[$i]->getName() === $name){
                unset($airlineArray[$i]);
                $sds->setStorageAll("airlineArray", $airlineArray);
                break;
            }

        return $this->render('home/airline/airlineDelete.html.twig', [
            "airline" => $name
        ]);
    }

    #[Route("/airline/update")]
    public function airlineUpdateRender(SharedDataService $sds): Response
    {
    }

    #[Route("/route", name: 'route')]
    public function routeRender(SharedDataService $sds) : Response {
        return $this->render('home/route/route.html.twig', [
            "routes" => $sds->getStorage("routeArray")
        ]);
    }

    #[Route("/route/create")]
    public function routeAddRender(Request $request, SharedDataService $sds): Response
    {
        $form = $this->createForm(RouteForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $originAirport = $formData["originAirport"];
            $destinationAirport = $formData["destinationAirport"];
            $airline = $formData["airline"];

            $airlineArray = $sds->getStorage("airlineArray");
            $airportArray = $sds->getStorage("airportArray");

            // array_search did not work as intended
            $returnValueAirline = $this->search($airlineArray, $airline);
            $returnValueOriginAirport = $this->search($airportArray, $originAirport);
            $returnValueDestinationAirport = $this->search($airportArray, $destinationAirport);

            if($returnValueAirline !== -1 && $returnValueOriginAirport !== -1 && $returnValueDestinationAirport !== -1)
                $sds->setStorage("routeArray", new RouteModel(
                    $returnValueAirline, $returnValueOriginAirport, $returnValueDestinationAirport
                ));

            return $this->redirectToRoute('route');
        }

        return $this->render('home/route/routeAdd.html.twig', [
            'form' => $form,
            "airlines" => $sds->getStorage("airlineArray"),
            "airports" => $sds->getStorage("airportArray")
        ]);
    }

    #[Route("/route/delete")]
    public function routeDeleteRender(SharedDataService $sds): Response
    {
    }

    #[Route("/route/delete")]
    public function routeUpdateRender(SharedDataService $sds): Response
    {
    }
}
?>
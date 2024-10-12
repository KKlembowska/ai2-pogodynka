<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Component\Routing\Attribute\Route;

//class WeatherController extends AbstractController
//{
//    #[Route('/weather/{id}', name: 'app_weather', requirements: ['id' => '\d+'])]
//    public function city(Location $location, MeasurementRepository $repository): Response
//{
//    $measurements = $repository->findByLocation($location);
//
//    return $this->render('weather/city.html.twig', [
//        'location' => $location,
//        'measurements' => $measurements,
//    ]);
//    }
//
//}
class WeatherController extends AbstractController{
#[Route('/weather/{city}/{countryCode?}', name: 'app_weather')]
    public function city(string $city, string $countryCode = null, MeasurementRepository $repository): Response
{

    $location = $repository->findLocationByCityAndCountry($city, $countryCode);

    if (!$location) {
        throw $this->createNotFoundException('Lokalizacja nie została znaleziona');
    }

    $measurements = $repository->findByLocation($location);
    dump($measurements);

    return $this->render('weather/city.html.twig', [
        'location' => $location,
        'city' => $city,
        'countryCode' => $countryCode,
        'measurements' => $measurements,
    ]);
}}
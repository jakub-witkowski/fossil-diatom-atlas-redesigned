<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\Map\Icon\Icon;
use Symfony\UX\Map\InfoWindow;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestingMapsController extends AbstractController
{
    #[Route('/testing-maps', name: 'app_testing_maps', methods: 'GET')]
    public function index(EntityManagerInterface $em): Response
    {
        $photoRepository = $em->getRepository(Photo::class);
        $photo1 = $photoRepository->findOneBy([
            'id' => 12
        ]);

        $map = new Map();
        $icon = Icon::ux('fa:map-marker')->width(24)->height(24);

        $map
        ->center(new Point(0, 0))
        ->zoom(3)
        ->minZoom(3)
        ->maxZoom(10)
        // ->fitBoundsToMarkers()
        ->addMarker(new Marker(
            position: new Point(
                $photo1->getSlide()->getSample()->getSite()->getLatitude(),
                $photo1->getSlide()->getSample()->getSite()->getLongitude()
            ),
            title: $photo1->getSlide()->getSample()->getSite()->printSiteInfo(),
            infoWindow: new InfoWindow(
            headerContent: '<b>Lyon</b>',
            content: 'The French town in the historic Rhône-Alpes region, located at the junction of the Rhône and Saône rivers.'
             ),
            icon: $icon,
        ))
        ;

        return $this->render('testing-maps/index.html.twig', [
            'photo' => $photo1,
            'icon' => $icon,
            'map' => $map
        ]);
    }
}

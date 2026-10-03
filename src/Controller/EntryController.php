<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EntryController extends AbstractController
{

//    public function updateTimesViewed(Photo $photo, EntityManagerInterface $em)
//    {
//        $photo->incrementTimesViewed();
//        $em->flush();
//    }

    #[Route('/entry/{id<\d+>}', name: 'app_entry', methods: 'GET')]
    public function index(int $id, PhotoRepository $repository, EntityManagerInterface $em): Response
    {
        $photo = $repository->findOneBy([
            'id' => $id,
        ]);

        if (!$photo) {
            throw $this->createNotFoundException('Photo not found');
        }

        $year = date('Y');
        $url = 'https://fossil-diatoms.com/entry/' . $id;

//        $this->updateTimesViewed($photo, $em);

        return $this->render('entry/index.html.twig', [
            'controller_name' => 'EntryController',
            'year' => $year,
            'photo' => $photo,
            'url' => $url
        ]);
    }
}

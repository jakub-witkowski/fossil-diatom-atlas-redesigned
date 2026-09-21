<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Model\TestObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class TestingEntitiesController extends AbstractController
{
    #[Route('/testing-entities', name: 'app_testing_entities', methods: 'GET')]
    public function index(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $photoRepository = $em->getRepository(Photo::class);

        $photo1 = $photoRepository->findOneBy([
            'id' => 78
        ]);
        $photo2 =  $photoRepository->findOneBy([
            'id' => 55
        ]);
        $photo3 = $photoRepository->findOneBy([
            'id' => 255
        ]);
        $photo4 = $photoRepository->findOneBy([
            'id' => 6
        ]);
        $photo5 = $photoRepository->findOneBy([
            'id' => 46
        ]);
        $photo6 = $photoRepository->findOneBy([
            'id' => 207
        ]);
        $photo7 = $photoRepository->findOneBy([
            'id' => 264
        ]);

        $testObjects = [
            new TestObject(
                $photo1->getTaxon()->printTaxonName(),
                $photo1->printTaxonAuthorityAndDateForPhoto(),
                $photo1->getDescription(),
                $photo1->printLocalityAndAgeForPhoto(),
                $photo1->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo2->getTaxon()->printTaxonName(),
                $photo2->printTaxonAuthorityAndDateForPhoto(),
                $photo2->getDescription(),
                $photo2->printLocalityAndAgeForPhoto(),
                $photo2->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo3->getTaxon()->printTaxonName(),
                $photo3->printTaxonAuthorityAndDateForPhoto(),
                $photo3->getDescription(),
                $photo3->printLocalityAndAgeForPhoto(),
                $photo3->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo4->getTaxon()->printTaxonName(),
                $photo4->printTaxonAuthorityAndDateForPhoto(),
                $photo4->getDescription(),
                $photo4->printLocalityAndAgeForPhoto(),
                $photo4->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo5->getTaxon()->printTaxonName(),
                $photo5->printTaxonAuthorityAndDateForPhoto(),
                $photo5->getDescription(),
                $photo5->printLocalityAndAgeForPhoto(),
                $photo5->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo6->getTaxon()->printTaxonName(),
                $photo6->printTaxonAuthorityAndDateForPhoto(),
                $photo6->getDescription(),
                $photo6->printLocalityAndAgeForPhoto(),
                $photo6->printMicroscopeAndTechniqueForPhoto(),
            ),
            new TestObject(
                $photo7->getTaxon()->printTaxonName(),
                $photo7->printTaxonAuthorityAndDateForPhoto(),
                $photo7->getDescription(),
                $photo7->printLocalityAndAgeForPhoto(),
                $photo7->printMicroscopeAndTechniqueForPhoto(),
            ),
        ];

        $jsonContent = $serializer->serialize($testObjects, 'json');
// dd($testObjects);

        return JsonResponse::fromJsonString($jsonContent);
        // return $this->json($testObjects);
        // return JsonResponse::fromJsonString($this->serializer->serialize($testObjects, 'json'), JsonResponse::HTTP_CREATED);
    }
}

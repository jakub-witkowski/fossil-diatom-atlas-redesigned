<?php

namespace App\Entity;

use App\Repository\UniSzczecinSlideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniSzczecinSlideRepository::class)]
class UniSzczecinSlide extends Slide
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function printSlideInfo(): string
    {
        $prefix = "University of Szczecin Diatom Collection (SZCZ) slide " . $this->getLabel();

        return $prefix;
    }
}

<?php

namespace App\Entity;

use App\Repository\BMslideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BMslideRepository::class)]
class BMslide extends Slide
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
        return "The Natural History Museum (London) slide " . $this->getLabel();
    }
}

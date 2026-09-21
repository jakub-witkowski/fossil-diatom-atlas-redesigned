<?php

namespace App\Entity;

use App\Repository\UnnamedSlideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnnamedSlideRepository::class)]
class UnnamedSlide extends Slide
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;

//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function printSlideInfo(): string
    {
               return "slide " . $this->getLabel();
    }
}

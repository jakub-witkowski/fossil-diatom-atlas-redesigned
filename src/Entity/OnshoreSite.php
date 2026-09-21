<?php

namespace App\Entity;

use App\Repository\OnshoreSiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OnshoreSiteRepository::class)]
class OnshoreSite extends Site
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localityName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function getLocalityName(): ?string
    {
        return $this->localityName;
    }

    public function setLocalityName(?string $localityName): static
    {
        $this->localityName = $localityName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function printName()
    {
        $name =
            $this->getLocalityName()
        ;
    }

    public function printLocality()
    {
        $locality =
            $this->getCountry()
        ;

        return $locality;
    }

    public function printSiteInfo() : string
    {
//        $info = '';

        if ($this->getLocalityName() !== null)
            $info = $this->getLocalityName() . ', ' . $this->getCountry();
        else
            $info = $this->getCountry();

        return $info;
    }
}

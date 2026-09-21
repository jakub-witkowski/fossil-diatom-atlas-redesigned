<?php

namespace App\Entity;

use App\Repository\DredgedSiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DredgedSiteRepository::class)]
class DredgedSite extends Site
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameOrNumberPrimary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameOrNumberSecondary = null;

    #[ORM\ManyToOne(inversedBy: 'dredgedSites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Geography $geography = null;

    #[ORM\ManyToOne(inversedBy: 'dredgedSites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campaign $campaign = null;

//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function getNameOrNumberPrimary(): ?string
    {
        return $this->nameOrNumberPrimary;
    }

    public function setNameOrNumberPrimary(string $nameOrNumberPrimary): static
    {
        $this->nameOrNumberPrimary = $nameOrNumberPrimary;

        return $this;
    }

    public function getNameOrNumberSecondary(): ?string
    {
        return $this->nameOrNumberSecondary;
    }

    public function setNameOrNumberSecondary(?string $nameOrNumberSecondary): static
    {
        $this->nameOrNumberSecondary = $nameOrNumberSecondary;

        return $this;
    }

    public function getGeography(): ?Geography
    {
        return $this->geography;
    }

    public function setGeography(?Geography $geography): static
    {
        $this->geography = $geography;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): static
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function printName()
    {
        $name =
            $this->getCampaign()->getFullName() . ' dredging ' .
            $this->getNameOrNumberPrimary() .
            $this->getNameOrNumberSecondary()
        ;
        return $name;
    }

    public function printLocality()
    {
        $locality =
            $this->getGeography()->getFeaturePrimary() . ', ' .
            $this->getGeography()->getFeatureSecondary()
        ;

        return $locality;
    }

    public function printSiteInfo() : string
    {
        $info =
            $this->printName() . ', ' .
            $this->printLocality()
        ;

        return $info;
    }
}

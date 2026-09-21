<?php

namespace App\Entity;

use App\Repository\SpeciesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
class Species extends Taxon
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genusNameForSpecies = null;

    #[ORM\Column(length: 255)]
    private ?string $speciesName = null;

    #[ORM\Column(length: 255)]
    private ?string $speciesAuthority = null;

    #[ORM\Column]
    private ?int $speciesPublicationDate = null;

//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function getGenusNameForSpecies(): ?string
    {
        return $this->genusNameForSpecies;
    }

    public function setGenusNameForSpecies(string $genusNameForSpecies): static
    {
        $this->genusNameForSpecies = $genusNameForSpecies;

        return $this;
    }

    public function getSpeciesName(): ?string
    {
        return $this->speciesName;
    }

    public function setSpeciesName(string $speciesName): static
    {
        $this->speciesName = $speciesName;

        return $this;
    }

    public function getSpeciesAuthority(): ?string
    {
        return $this->speciesAuthority;
    }

    public function setSpeciesAuthority(string $speciesAuthority): static
    {
        $this->speciesAuthority = $speciesAuthority;

        return $this;
    }

    public function printTaxonInfo(): string
    {
        $taxonInfo =
            $this->getGenusNameForSpecies() . ' ' .
            $this->getSpeciesName() . ' ' .
            $this->getSpeciesAuthority() . ' (' .
            $this->getSpeciesPublicationDate() . ')'
        ;

        return $taxonInfo;
    }

    public function printTaxonName(): string
    {
        $taxonName =
            $this->getGenusNameForSpecies() . ' ' .
            $this->getSpeciesName()
            // $this->getSpeciesName() . ' '
        ;

        return $taxonName;
    }

    public function printAuthorityAndDate(): string
    {
        return $this->getSpeciesAuthority() . ' (' . $this->getSpeciesPublicationDate() . ')';
    }

    public function getSpeciesPublicationDate(): ?int
    {
        return $this->speciesPublicationDate;
    }

    public function setSpeciesPublicationDate(int $speciesPublicationDate): static
    {
        $this->speciesPublicationDate = $speciesPublicationDate;

        return $this;
    }
}

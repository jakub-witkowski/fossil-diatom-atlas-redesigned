<?php

namespace App\Entity;

use App\Repository\VarietyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VarietyRepository::class)]
class Variety extends Taxon
{
//    #[ORM\Id]
//    #[ORM\GeneratedValue]
//    #[ORM\Column]
//    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genusNameForVariety = null;

    #[ORM\Column(length: 255)]
    private ?string $speciesNameForVariety = null;

    #[ORM\Column(length: 255)]
    private ?string $speciesAuthorityForVariety = null;

    #[ORM\Column(length: 255)]
    private ?string $varietyName = null;

    #[ORM\Column(length: 255)]
    private ?string $varietyAuthority = null;

    #[ORM\Column(nullable: true)]
    private ?int $varietyPublicationDate = null;

//    public function getId(): ?int
//    {
//        return $this->id;
//    }

    public function getGenusNameForVariety(): ?string
    {
        return $this->genusNameForVariety;
    }

    public function setGenusNameForVariety(string $genusNameForVariety): static
    {
        $this->genusNameForVariety = $genusNameForVariety;

        return $this;
    }

    public function getSpeciesNameForVariety(): ?string
    {
        return $this->speciesNameForVariety;
    }

    public function setSpeciesNameForVariety(string $speciesNameForVariety): static
    {
        $this->speciesNameForVariety = $speciesNameForVariety;

        return $this;
    }

    public function getSpeciesAuthorityForVariety(): ?string
    {
        return $this->speciesAuthorityForVariety;
    }

    public function setSpeciesAuthorityForVariety(string $speciesAuthorityForVariety): static
    {
        $this->speciesAuthorityForVariety = $speciesAuthorityForVariety;

        return $this;
    }

    public function getVarietyName(): ?string
    {
        return $this->varietyName;
    }

    public function setVarietyName(string $varietyName): static
    {
        $this->varietyName = $varietyName;

        return $this;
    }

    public function getVarietyAuthority(): ?string
    {
        return $this->varietyAuthority;
    }

    public function setVarietyAuthority(string $varietyAuthority): static
    {
        $this->varietyAuthority = $varietyAuthority;

        return $this;
    }

    public function printTaxonInfo(): string
    {
         $taxonInfo =
            $this->getGenusNameForVariety() . ' ' .
            $this->getSpeciesNameForVariety() . ' ' .
            $this->getSpeciesAuthorityForVariety() . ' var. ' .
            $this->getVarietyName() . ' ' .
            $this->getVarietyAuthority() . ' (' .
            $this->getVarietyPublicationDate() . ')'
        ;

        return $taxonInfo;
    }

    public function printTaxonName(): string
    {
        $taxonName =
            $this->getGenusNameForVariety() . ' ' .
            $this->getSpeciesNameForVariety() . ' var. ' .
            $this->getVarietyName()
            // $this->getVarietyName() . ' '
        ;

        return $taxonName;
    }

    public function printAuthorityAndDate(): string
    {
        return $this->getVarietyAuthority() . ' (' . $this->getVarietyPublicationDate() . ')';
    }

    public function getVarietyPublicationDate(): ?int
    {
        return $this->varietyPublicationDate;
    }

    public function setVarietyPublicationDate(?int $varietyPublicationDate): static
    {
        $this->varietyPublicationDate = $varietyPublicationDate;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TaxonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: TaxonRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'genus' => Genus::class,
    'species' => Species::class,
    'variety' => Variety::class,
])]
class Taxon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diatomBase = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'taxon')]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiatomBase(): ?string
    {
        return $this->diatomBase;
    }

    public function setDiatomBase(string $diatomBase): static
    {
        $this->diatomBase = $diatomBase;

        return $this;
    }

    public function printTaxonInfo(): string
    {
        return $this;
    }

    public function printTaxonName(): string
    {
        return $this;
    }

    public function printAuthorityAndDate(): string
    {
        return $this;
    }

    public function __toString(): string
    {
        return $this->printTaxonInfo();
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setTaxon($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getTaxon() === $this) {
                $photo->setTaxon(null);
            }
        }

        return $this;
    }
}

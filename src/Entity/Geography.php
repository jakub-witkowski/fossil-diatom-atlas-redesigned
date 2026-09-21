<?php

namespace App\Entity;

use App\Repository\GeographyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeographyRepository::class)]
class Geography
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $featurePrimary = null;

    #[ORM\Column(length: 255)]
    private ?string $featureSecondary = null;

    /**
     * @var Collection<int, DeepSeaSite>
     */
    #[ORM\OneToMany(targetEntity: DeepSeaSite::class, mappedBy: 'geography')]
    private Collection $deepSeaSites;

    /**
     * @var Collection<int, DredgedSite>
     */
    #[ORM\OneToMany(targetEntity: DredgedSite::class, mappedBy: 'geography')]
    private Collection $dredgedSites;

    public function __construct()
    {
        $this->deepSeaSites = new ArrayCollection();
        $this->dredgedSites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeaturePrimary(): ?string
    {
        return $this->featurePrimary;
    }

    public function setFeaturePrimary(string $featurePrimary): static
    {
        $this->featurePrimary = $featurePrimary;

        return $this;
    }

    public function getFeatureSecondary(): ?string
    {
        return $this->featureSecondary;
    }

    public function setFeatureSecondary(string $featureSecondary): static
    {
        $this->featureSecondary = $featureSecondary;

        return $this;
    }

    /**
     * @return Collection<int, DeepSeaSite>
     */
    public function getDeepSeaSites(): Collection
    {
        return $this->deepSeaSites;
    }

    public function addDeepSeaSite(DeepSeaSite $deepSeaSite): static
    {
        if (!$this->deepSeaSites->contains($deepSeaSite)) {
            $this->deepSeaSites->add($deepSeaSite);
            $deepSeaSite->setGeography($this);
        }

        return $this;
    }

    public function removeDeepSeaSite(DeepSeaSite $deepSeaSite): static
    {
        if ($this->deepSeaSites->removeElement($deepSeaSite)) {
            // set the owning side to null (unless already changed)
            if ($deepSeaSite->getGeography() === $this) {
                $deepSeaSite->setGeography(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DredgedSite>
     */
    public function getDredgedSites(): Collection
    {
        return $this->dredgedSites;
    }

    public function addDredgedSite(DredgedSite $dredgedSite): static
    {
        if (!$this->dredgedSites->contains($dredgedSite)) {
            $this->dredgedSites->add($dredgedSite);
            $dredgedSite->setGeography($this);
        }

        return $this;
    }

    public function removeDredgedSite(DredgedSite $dredgedSite): static
    {
        if ($this->dredgedSites->removeElement($dredgedSite)) {
            // set the owning side to null (unless already changed)
            if ($dredgedSite->getGeography() === $this) {
                $dredgedSite->setGeography(null);
            }
        }

        return $this;
    }
}

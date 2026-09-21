<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $abbreviation = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    /**
     * @var Collection<int, DeepSeaSite>
     */
    #[ORM\OneToMany(targetEntity: DeepSeaSite::class, mappedBy: 'campaign')]
    private Collection $deepSeaSites;

    /**
     * @var Collection<int, DredgedSite>
     */
    #[ORM\OneToMany(targetEntity: DredgedSite::class, mappedBy: 'campaign')]
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

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): static
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

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
            $deepSeaSite->setCampaign($this);
        }

        return $this;
    }

    public function removeDeepSeaSite(DeepSeaSite $deepSeaSite): static
    {
        if ($this->deepSeaSites->removeElement($deepSeaSite)) {
            // set the owning side to null (unless already changed)
            if ($deepSeaSite->getCampaign() === $this) {
                $deepSeaSite->setCampaign(null);
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
            $dredgedSite->setCampaign($this);
        }

        return $this;
    }

    public function removeDredgedSite(DredgedSite $dredgedSite): static
    {
        if ($this->dredgedSites->removeElement($dredgedSite)) {
            // set the owning side to null (unless already changed)
            if ($dredgedSite->getCampaign() === $this) {
                $dredgedSite->setCampaign(null);
            }
        }

        return $this;
    }
}

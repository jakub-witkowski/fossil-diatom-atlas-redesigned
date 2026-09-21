<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'deep-sea-site' => DeepSeaSite::class,
    'dredged-site' => DredgedSite::class,
    'onshore-site' => OnshoreSite::class,
    'unknown-site' => UnknownSite::class
])]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Sample>
     */
    #[ORM\OneToMany(targetEntity: Sample::class, mappedBy: 'site')]
    private Collection $samples;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    public function __construct()
    {
        $this->samples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Sample>
     */
    public function getSamples(): Collection
    {
        return $this->samples;
    }

    public function addSample(Sample $sample): static
    {
        if (!$this->samples->contains($sample)) {
            $this->samples->add($sample);
            $sample->setSite($this);
        }

        return $this;
    }

    public function removeSample(Sample $sample): static
    {
        if ($this->samples->removeElement($sample)) {
            // set the owning side to null (unless already changed)
            if ($sample->getSite() === $this) {
                $sample->setSite(null);
            }
        }

        return $this;
    }

    public function printName()
    {
        return $this;
    }

    public function printLocality()
    {
        return $this;
    }

    public function printSiteInfo(): string
    {
        return $this;
    }

    public function __toString() : string
    {
        return $this->printSiteInfo();
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}

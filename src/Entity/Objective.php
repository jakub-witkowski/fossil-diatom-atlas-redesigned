<?php

namespace App\Entity;

use App\Repository\ObjectiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjectiveRepository::class)]
class Objective
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Microscope>
     */
    #[ORM\OneToMany(targetEntity: Microscope::class, mappedBy: 'objective')]
    private Collection $microscopes;

    public function __construct()
    {
        $this->microscopes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Microscope>
     */
    public function getMicroscopes(): Collection
    {
        return $this->microscopes;
    }

    public function addMicroscope(Microscope $microscope): static
    {
        if (!$this->microscopes->contains($microscope)) {
            $this->microscopes->add($microscope);
            $microscope->setObjective($this);
        }

        return $this;
    }

    public function removeMicroscope(Microscope $microscope): static
    {
        if ($this->microscopes->removeElement($microscope)) {
            // set the owning side to null (unless already changed)
            if ($microscope->getObjective() === $this) {
                $microscope->setObjective(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}

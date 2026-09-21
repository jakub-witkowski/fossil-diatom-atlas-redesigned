<?php

namespace App\Entity;

use App\Repository\MicroscopeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MicroscopeRepository::class)]
class Microscope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'microscopes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producer $producer = null;

    #[ORM\ManyToOne(inversedBy: 'microscopes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'microscopes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Objective $objective = null;

    #[ORM\ManyToOne(inversedBy: 'microscopes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Camera $camera = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'microscope')]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducer(): ?Producer
    {
        return $this->producer;
    }

    public function setProducer(?Producer $producer): static
    {
        $this->producer = $producer;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): static
    {
        $this->objective = $objective;

        return $this;
    }

    public function getCamera(): ?Camera
    {
        return $this->camera;
    }

    public function setCamera(?Camera $camera): static
    {
        $this->camera = $camera;

        return $this;
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
            $photo->setMicroscope($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getMicroscope() === $this) {
                $photo->setMicroscope(null);
            }
        }

        return $this;
    }

    public function getSetup(): string
    {
        return 'Photographed using ' .
            $this->getProducer() . ' ' .
            $this->getModel() . ' microscope with ' .
            $this->definePrefix($this->getObjective()->getName()[0]) .
            $this->getObjective() . ' objective, fitted with ' .
            $this->definePrefix($this->getCamera()->getName()[0]) .
            $this->getCamera() . 'camera. '
        ;
    }

    public function definePrefix($c): string
    {
        $consonants = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];
        $vowels = ['A', 'E', 'I', 'O', 'U', 'Y'];

        $prefix = null;

        for ($i = 0; $i < count($consonants); $i++)
        {
            if ($c === $consonants[$i] OR $c === strtolower($consonants[$i])) {
                $prefix = 'a ';
                break;
            }
        }

        if ($prefix === null)
        {
            for ($i = 0; $i < count($vowels); $i++)
            {
                if ($c === $vowels[$i] OR $c === strtolower($vowels[$i])) {
                    $prefix = 'an ';
                    break;
                }
            }
        }

        return $prefix;
    }
}

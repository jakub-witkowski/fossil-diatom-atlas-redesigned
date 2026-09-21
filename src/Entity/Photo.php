<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
//use App\Service\UploaderHelper;
use Doctrine\DBAL\Types\Types;
//use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isPublished = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $totalTimesViewed = 0;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
//    #[Gedmo\Timestampable(on: 'create')]
//    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateAdded = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Taxon $taxon = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Slide $slide = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Microscope $microscope = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Technique $technique = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RelativeAge $relativeAge = null;

    #[ORM\Column(nullable: true)]
    private ?float $specimenNumericalAge = null;

    #[ORM\Column(nullable: true)]
    private ?int $monthlyViews = 0;

    #[ORM\Column(nullable: true)]
    private ?int $weeklyViews = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

//    public function getFilename(): ?string
//    {
//        return UploaderHelper::PHOTO . '/' . $this->filename;
//    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTotalTimesViewed(): ?int
    {
        return $this->totalTimesViewed;
    }

    public function setTimesViewed(int $totalTimesViewed): static
    {
        $this->totalTimesViewed = $totalTimesViewed;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): static
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getTaxon(): ?Taxon
    {
        return $this->taxon;
    }

    public function setTaxon(?Taxon $taxon): static
    {
        $this->taxon = $taxon;

        return $this;
    }

    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    public function setSlide(?Slide $slide): static
    {
        $this->slide = $slide;

        return $this;
    }

    public function getMicroscope(): ?Microscope
    {
        return $this->microscope;
    }

    public function setMicroscope(?Microscope $microscope): static
    {
        $this->microscope = $microscope;

        return $this;
    }

    public function getTechnique(): ?Technique
    {
        return $this->technique;
    }

    public function setTechnique(?Technique $technique): static
    {
        $this->technique = $technique;

        return $this;
    }

    public function getRelativeAge(): ?RelativeAge
    {
        return $this->relativeAge;
    }

    public function setRelativeAge(?RelativeAge $relativeAge): static
    {
        $this->relativeAge = $relativeAge;

        return $this;
    }

    public function incrementTotalTimesViewed(): self
    {
        $this->totalTimesViewed = $this->totalTimesViewed + 1;

        return $this;
    }

    public function getSpecimenNumericalAge(): ?float
    {
        return $this->specimenNumericalAge;
    }

    public function setSpecimenNumericalAge(?float $specimenNumericalAge): static
    {
        $this->specimenNumericalAge = $specimenNumericalAge;

        return $this;
    }

    public function getMonthlyViews(): ?int
    {
        return $this->monthlyViews;
    }

    public function setMonthlyViews(?int $monthlyViews): static
    {
        $this->monthlyViews = $monthlyViews;

        return $this;
    }

    public function getWeeklyViews(): ?int
    {
        return $this->weeklyViews;
    }

    public function setWeeklyViews(?int $weeklyViews): static
    {
        $this->weeklyViews = $weeklyViews;

        return $this;
    }

    public function printTaxonNameForPhoto(): string
    {
        return $this->getTaxon()->printTaxonName();
    }

    public function printTaxonAuthorityAndDateForPhoto(): string
    {
        return $this->getTaxon()->printAuthorityAndDate();
    }

    public function printLocalityAndAgeForPhoto(): string
    {
        $info = '';

        if ($this->getSlide()->getSample()->getSite() instanceof UnknownSite)
        {
            $info =
                $this->getSlide()->getSample()->getSite()->printSiteInfo() . ', ' .
                $this->getSlide()->printSlideInfo() . ' (' .
                $this->getRelativeAge() . ')';
        }
        else if ($this->getSlide()->getSample()->getSite() instanceof DeepSeaSite)
        {
            $info =
                $this->getSlide()->getSample()->printInfo() . ' (' .
                $this->getRelativeAge() . ')';
        }
        else if ($this->getSlide()->getSample()->getSite() instanceof DredgedSite)
        {
            ($this->getSlide() instanceof BMslide) ? $prefix = ', The Natural History Museum (London) slide ' : $prefix = 'sample ';

            $info =
                $this->getSlide()->getSample()->getSite()->printSiteInfo() .
                $prefix .
                $this->getSlide()->getLabel() . ' (' .
                $this->getRelativeAge() . ')';
        }
        else if ($this->getSlide() instanceof BMslide)
        {
            $info =
                $this->getSlide()->getSample()->getSite()->printSiteInfo() . ', ' .
                $this->getSlide()->printSlideInfo() . ' (' .
                $this->getRelativeAge() . ')';
        }
        else if ($this->getSlide()->getSample()->getSite() instanceof OnshoreSite)
        {
            $info =
                $this->getSlide()->getSample()->getSite()->printSiteInfo() . ' (' .
                $this->getRelativeAge() . ')';
        }

        return $info;
    }

    public function printMicroscopeAndTechniqueForPhoto(): string
    {
        return $this->getMicroscope()->getSetup() . $this->getTechnique();
    }
}

<?php

namespace App\Model;

use Doctrine\ORM\Query\Expr\Func;

class TestObject
{
    public function __construct(
//        private int $id,
        private string $taxonName,
        private string $authorityAndDate,
        private string $description,
        private string $localityAndAge,
        private string $microscopeAndTechnique
    )
    {

    }

    public function getAuthorityAndDate(): string
    {
        return $this->authorityAndDate;
    }

//    public function getId(): int
//    {
//        return $this->id;
//    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTaxonName(): string
    {
        return $this->taxonName;
    }

    public function getLocalityAndAge(): string
    {
        return $this->localityAndAge;
    }

    public function getMicroscopeAndTechnique(): string
    {
        return $this->microscopeAndTechnique;
    }
}

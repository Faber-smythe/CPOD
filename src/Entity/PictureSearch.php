<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


class PictureSearch
{

    /**
     * [private description]
     * @var [string]
     */
    private $country;

    /**
     * [private description]
     * @var [array]
     */
    private $tags;


    public function getCountry(): ?string
    {
        return $this->country ;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;

    }

    public function getTags(): ?array
    {
        return $this->tags ;
    }

    public function setTags(?array $tags): void
    {
        $this->tags = $tags;

    }
}

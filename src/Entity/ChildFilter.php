<?php

namespace App\Entity;

use App\Repository\ChildFilterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildFilterRepository::class)
 */
class ChildFilter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_age_limit;

    /**
     * @ORM\ManyToMany(targetEntity=Janre::class, cascade={"persist"})
     */
    private $janre_filter_id;

    public function __construct()
    {
        $this->janre_filter_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxYear(): ?int
    {
        return $this->max_year;
    }

    public function setMaxYear(?int $max_year): self
    {
        $this->max_year = $max_year;

        return $this;
    }

    public function getMaxAgeLimit(): ?int
    {
        return $this->max_age_limit;
    }

    public function setMaxAgeLimit(?int $max_age_limit): self
    {
        $this->max_age_limit = $max_age_limit;

        return $this;
    }

    /**
     * @return Collection|Janre[]
     */
    public function getJanreFilterId(): Collection
    {
        return $this->janre_filter_id;
    }

    public function addJanreFilterId(Janre $janreFilterId): self
    {
        if (!$this->janre_filter_id->contains($janreFilterId)) {
            $this->janre_filter_id[] = $janreFilterId;
        }

        return $this;
    }

    public function removeJanreFilterId(Janre $janreFilterId): self
    {
        $this->janre_filter_id->removeElement($janreFilterId);

        return $this;
    }
}

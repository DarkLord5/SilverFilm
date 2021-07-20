<?php

namespace App\Entity;

use App\Repository\JanreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JanreRepository::class)
 */
class Janre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $janreName;

    /**
     * @ORM\ManyToMany(targetEntity=Films::class, mappedBy="janres", cascade={"persist"})
     */
    private $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJanreName(): ?string
    {
        return $this->janreName;
    }

    public function setJanreName(string $janre_name): self
    {
        $this->janreName = $janre_name;

        return $this;
    }

    /**
     * @return Collection|Films[]
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Films $film): self
    {
        if (!$this->films->contains($film)) {
            $this->films[] = $film;
            $film->addJanre($this);
        }

        return $this;
    }

    public function removeFilm(Films $film): self
    {
        if ($this->films->removeElement($film)) {
            $film->removeJanre($this);
        }

        return $this;
    }
}

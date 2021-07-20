<?php

namespace App\Entity;

use App\Repository\FilmsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmsRepository::class)
 */
class Films
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
    private $film_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $age_limit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $director;


	
    /**
     * @ORM\ManyToMany(targetEntity=Janre::class, inversedBy="films",cascade={"persist"})
     */
    private $janres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Picture;

    public function __construct()
    {
        $this->janres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilmName(): ?string
    {
        return $this->film_name;
    }

    public function setFilmName(string $film_name): self
    {
        $this->film_name = $film_name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

	
	
    public function getAgeLimit(): ?int
    {
        return $this->age_limit;
    }

    public function setAgeLimit(int $age_limit): self
    {
        $this->age_limit = $age_limit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection|Janre[]
     */
    public function getJanres(): Collection
    {
        return $this->janres;
    }

    public function addJanre(Janre $janre): self
    {
        if (!$this->janres->contains($janre)) {
            $this->janres[] = $janre;
        }

        return $this;
    }
	
	public function setJanre(array $janre): self
    {
        $this->janres = $janre;

        return $this;
    }
	
	
    public function removeJanre(Janre $janre): self
    {
        $this->janres->removeElement($janre);

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }
}

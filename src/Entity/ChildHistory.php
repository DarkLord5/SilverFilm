<?php

namespace App\Entity;

use App\Repository\ChildHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildHistoryRepository::class)
 */
class ChildHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=child::class, inversedBy="history")
     * @ORM\JoinColumn(nullable=false)
     */
    private $child;

    /**
     * @ORM\ManyToOne(targetEntity=films::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChild(): ?child
    {
        return $this->child;
    }

    public function setChild(?child $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getFilm(): ?films
    {
        return $this->film;
    }

    public function setFilm(?films $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getTimer(): ?\DateTimeInterface
    {
        return $this->timer;
    }

    public function setTimer(\DateTimeInterface $timer): self
    {
        $this->timer = $timer;

        return $this;
    }
}

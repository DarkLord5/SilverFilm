<?php

namespace App\Entity;

use App\Repository\ChildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChildRepository::class)
 */
class Child
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
    private $email;

	
	 
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity=ChildFilter::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $filter;

    /**
     * @ORM\OneToMany(targetEntity=ChildHistory::class, mappedBy="child")
     */
    private $history;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_CHILD'];

  

    public function __construct()
    {
        $this->Child_History = new ArrayCollection();
        $this->history = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

	
	
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFilter(): ?ChildFilter
    {
        return $this->filter;
    }

    public function setFilter(ChildFilter $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return Collection|ChildHistory[]
     */
    public function getHistory(): Collection
    {
        return $this->history;
    }

    public function addHistory(ChildHistory $history): self
    {
        if (!$this->history->contains($history)) {
            $this->history[] = $history;
            $history->setChild($this);
        }

        return $this;
    }

    public function removeHistory(ChildHistory $history): self
    {
        if ($this->history->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getChild() === $this) {
                $history->setChild(null);
            }
        }

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_CHILD';
        return array_unique($roles);
    }

    public function setRoles(array $role): self
    {
        $this->role = $role;

        return $this;
    }

}

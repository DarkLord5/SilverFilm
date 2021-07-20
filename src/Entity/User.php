<?php

namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
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
     * @ORM\OneToMany(targetEntity=History::class, mappedBy="user")
     */
    private $histories;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_CHILD', 'ROLE_USER', 'ROLE_ADMIN'];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parentID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $childID;

    /**
     * @ORM\OneToOne(targetEntity=ChildFilter::class, cascade={"persist", "remove"})
     */
    private $filter;
	
   

    public function __construct()
    {
        $this->History = new ArrayCollection();
        $this->histories = new ArrayCollection();
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
	/**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }
	/**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
       
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
	/**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
	/**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        //If you store any temporary, sensitive data on the user, clear it here
        //  $this->plainPassword = null;
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

    /**
     * @return Collection|History[]
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories[] = $history;
            $history->setUser($this);
        }

        return $this;
    }

    public function removeHistory(History $history): self
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getUser() === $this) {
                $history->setUser(null);
            }
        }

        return $this;
    }

    public function getParentID(): ?int
    {
        return $this->parentID;
    }

    public function setParentID(?int $parentID): self
    {
        $this->parentID = $parentID;

        return $this;
    }

    public function getChildID(): ?int
    {
        return $this->childID;
    }

    public function setChildID(?int $childID): self
    {
        $this->childID = $childID;

        return $this;
    }

    public function getFilter(): ?ChildFilter
    {
        return $this->filter;
    }

    public function setFilter(?ChildFilter $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    

    
}

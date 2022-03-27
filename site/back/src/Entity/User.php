<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 30)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100)]
    private $email;

    #[ORM\Column(type: 'date')]
    private $birthdate;

    #[ORM\Column(type: 'decimal', precision: 10, scale: '0')]
    private $number;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'users')]
    private $role;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'users')]
    private $offer;

    #[ORM\ManyToMany(targetEntity: Badge::class, inversedBy: 'users')]
    private $badge;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'users')]
    private $module;

    #[ORM\ManyToMany(targetEntity: UserAnswer::class, inversedBy: 'users')]
    private $user_answer;

    public function __construct()
    {
        $this->badge = new ArrayCollection();
        $this->module = new ArrayCollection();
        $this->user_answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadge(): Collection
    {
        return $this->badge;
    }

    public function addBadge(Badge $badge): self
    {
        if (!$this->badge->contains($badge)) {
            $this->badge[] = $badge;
        }

        return $this;
    }

    public function removeBadge(Badge $badge): self
    {
        $this->badge->removeElement($badge);

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Module $module): self
    {
        if (!$this->module->contains($module)) {
            $this->module[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->module->removeElement($module);

        return $this;
    }

    /**
     * @return Collection<int, UserAnswer>
     */
    public function getUserAnswer(): Collection
    {
        return $this->user_answer;
    }

    public function addUserAnswer(UserAnswer $userAnswer): self
    {
        if (!$this->user_answer->contains($userAnswer)) {
            $this->user_answer[] = $userAnswer;
        }

        return $this;
    }

    public function removeUserAnswer(UserAnswer $userAnswer): self
    {
        $this->user_answer->removeElement($userAnswer);

        return $this;
    }
}

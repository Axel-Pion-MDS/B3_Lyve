<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Monolog\DateTimeImmutable;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(type: 'string', length: 12)]
    private $number;

//    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'users')]
//    private $role;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'users')]
    private $offer;

    #[ORM\ManyToMany(targetEntity: Badge::class, inversedBy: 'users')]
    private $badges;

    #[ORM\ManyToMany(targetEntity: Answer::class, inversedBy: 'users')]
    private $answers;

    #[ORM\Column(type: 'datetime', nullable:true)]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable:true)]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'boolean')]
    private $isFirstConnection;

    #[ORM\Column(type: 'boolean')]
    private $isPasswordChanged;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $picture;

    #[ORM\ManyToMany(targetEntity: Timesheet::class, mappedBy: 'user')]
    private $timesheets;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->module = new ArrayCollection();
        $this->message = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->timesheets = new ArrayCollection();
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

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        // allows for chaining
        return $this;
    }

    public function addRole(string $role): User
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function removeRole($role): User
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

//    public function getRole(): ?Role
//    {
//        return $this->role;
//    }
//
//    public function setRole(?Role $role): self
//    {
//        $this->role = $role;
//
//        return $this;
//    }

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
    public function getBadges(): ?Collection
    {
        return $this->badges;
    }

    public function addBadges(?Badge $badges): self
    {
        if (!$this->badges->contains($badges)) {
            $this->badges[] = $badges;
        }

        return $this;
    }

    public function removeBadges(Badge $badges): self
    {
        $this->badges->removeElement($badges);

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answers->removeElement($answer);

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    #[ORM\PrePersist]
    public function beforePersist(): void
    {
        $this->created_at = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function beforeUpdate(): void
    {
        $this->updated_at = new \DateTime();
    }

    public function getIsFirstConnection(): ?bool
    {
        return $this->isFirstConnection;
    }

    public function setIsFirstConnection(bool $isFirstConnection): self
    {
        $this->isFirstConnection = $isFirstConnection;

        return $this;
    }

    public function getIsPasswordChanged(): ?bool
    {
        return $this->isPasswordChanged;
    }

    public function setIsPasswordChanged(bool $isPasswordChanged): self
    {
        $this->isPasswordChanged = $isPasswordChanged;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Timesheet>
     */
    public function getTimesheets(): Collection
    {
        return $this->timesheets;
    }

    public function addTimesheet(Timesheet $timesheet): self
    {
        if (!$this->timesheets->contains($timesheet)) {
            $this->timesheets[] = $timesheet;
            $timesheet->addUser($this);
        }

        return $this;
    }

    public function removeTimesheet(Timesheet $timesheet): self
    {
        if ($this->timesheets->removeElement($timesheet)) {
            $timesheet->removeUser($this);
        }

        return $this;
    }
}

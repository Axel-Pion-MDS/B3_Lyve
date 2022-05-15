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
    #[ApiProperty(identifier: false)]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 30)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100)]
    #[ApiProperty(identifier: true)]
    private $email;

    #[ORM\Column(type: 'date')]
    private $birthdate;

    #[ORM\Column(type: 'string', length: 12)]
    private $number;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'users')]
    private $role;

    #[ORM\ManyToOne(targetEntity: Offer::class, inversedBy: 'users')]
    private $offer;

    #[ORM\ManyToMany(targetEntity: Badge::class, inversedBy: 'users')]
    private $badges;

    #[ORM\ManyToMany(targetEntity: UserAnswer::class, inversedBy: 'users')]
    private $user_answer;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Message::class)]
    private $message;

    #[ORM\Column(type: 'datetime', nullable:true)]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable:true)]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->module = new ArrayCollection();
        $this->user_answer = new ArrayCollection();
        $this->message = new ArrayCollection();
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

    /**
     * @return Collection<int, Message>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

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

    public function getRoles(): array
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
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

}

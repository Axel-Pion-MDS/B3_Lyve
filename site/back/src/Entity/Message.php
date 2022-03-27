<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'message')]
    private $user;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'messages')]
    private $answer;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'answer')]
    private $messages;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(self $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(self $answer): self
    {
        $this->answer->removeElement($answer);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(self $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->addAnswer($this);
        }

        return $this;
    }

    public function removeMessage(self $message): self
    {
        if ($this->messages->removeElement($message)) {
            $message->removeAnswer($this);
        }

        return $this;
    }
}

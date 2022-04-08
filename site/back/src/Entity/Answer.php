<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get', 'put', 'patch', 'delete'],
    order: ['updated_at' => 'DESC', 'created_at' => 'ASC'],
    paginationEnabled: false,
)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer;

    #[ORM\Column(type: 'boolean')]
    private $isCorrect;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'answer')]
    private $question;

    #[ORM\ManyToMany(targetEntity: UserAnswer::class, inversedBy: 'answers')]
    private $user_answer;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updated_at;

    public function __construct()
    {
        $this->user_answer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): self
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}

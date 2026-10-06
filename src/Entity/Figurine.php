<?php

namespace App\Entity;

use App\Entity\Trait\TimestampableTrait;
use App\Repository\FigurineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Une figurine partagée par un utilisateur.
 *
 * L'image est stockée sous forme d'URL publique (choix retenu plutôt que
 * VichUploader) afin de ne pas avoir à gérer le stockage de fichiers.
 */
#[ORM\Entity(repositoryClass: FigurineRepository::class)]
#[ORM\Table(name: 'figurines')]
#[ORM\HasLifecycleCallbacks]
class Figurine
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(
        min: 3,
        max: 100,
        minMessage: 'Le titre doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le titre ne peut pas dépasser {{ limit }} caractères.'
    )]
    #[Assert\Regex(pattern: '/spam/i', match: false, message: 'Le mot « spam » est interdit dans le titre.')]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: "L'URL de l'image est obligatoire.")]
    #[Assert\Url(message: "L'URL de l'image n'est pas valide.", requireTld: true)]
    #[Assert\Length(max: 500, maxMessage: "L'URL ne peut pas dépasser {{ limit }} caractères.")]
    private ?string $imageName = null;

    /**
     * Propriétaire de la figurine : une figurine appartient à un seul utilisateur.
     */
    #[ORM\ManyToOne(inversedBy: 'figurines')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

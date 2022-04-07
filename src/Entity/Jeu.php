<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank
     */
    private $nom;

    #[ORM\Column(type: 'integer')]
    /**
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1960,
     *      max = 2025,
     *      notInRangeMessage = "L'année doit être comprise entre {{ min }} et {{ max }}.",
     * )
     */
    private $anneeSortie;

    #[ORM\Column(type: 'float')]
    /**
     * @Assert\Positive
     */
    private $prixSortie;

    #[ORM\ManyToOne(targetEntity: Editeur::class, inversedBy: 'jeux')]
    #[ORM\JoinColumn(nullable: false)]
    private $editeur;

    #[ORM\Column(type: 'text', nullable: true)]
    private $image;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    public function getAnneeSortie(): ?int {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(int $anneeSortie): self {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    public function getPrixSortie(): ?float {
        return $this->prixSortie;
    }

    public function setPrixSortie(float $prixSortie): self {
        $this->prixSortie = $prixSortie;

        return $this;
    }

    public function getEditeur(): ?Editeur {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): self {
        $this->editeur = $editeur;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

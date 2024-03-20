<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\OneToMany(targetEntity: Auteur::class, mappedBy: 'livre')]
    private Collection $auteurs;

    #[ORM\ManyToOne(targetEntity:"App\Entity\Auteur", inversedBy: 'livres', cascade: ["persist"])]
    #[Assert\Type(type: "App\Entity\Auteur")]
    #[Assert\Valid]
    private ?Auteur $auteur_id = null;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Auteur>
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteur $auteur): static
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs->add($auteur);
            $auteur->setLivre($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): static
    {
        if ($this->auteurs->removeElement($auteur)) {
            // set the owning side to null (unless already changed)
            if ($auteur->getLivre() === $this) {
                $auteur->setLivre(null);
            }
        }

        return $this;
    }

    public function getAuteurId(): ?Auteur
    {
        return $this->auteur_id;
    }

    public function setAuteurId(?Auteur $auteur_id): self
    {
        $this->auteur_id = $auteur_id;

        return $this;
    }
}

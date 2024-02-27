<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private Collection $auteur;

    #[ORM\ManyToOne(inversedBy: 'livres', cascade: ["persist"])]
    private ?auteur $auteur_id = null;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
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
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Auteur $auteur): static
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur->add($auteur);
            $auteur->setLivre($this);
        }

        return $this;
    }

    public function removeAuteur(Auteur $auteur): static
    {
        if ($this->auteur->removeElement($auteur)) {
            // set the owning side to null (unless already changed)
            if ($auteur->getLivre() === $this) {
                $auteur->setLivre(null);
            }
        }

        return $this;
    }

    public function getAuteurId(): ?auteur
    {
        return $this->auteur_id;
    }

    public function setAuteurId(?auteur $auteur_id): static
    {
        $this->auteur_id = $auteur_id;

        return $this;
    }
}

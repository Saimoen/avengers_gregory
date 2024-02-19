<?php

namespace App\Entity;

use App\Repository\MarquePageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquePageRepository::class)]
class MarquePage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToMany(targetEntity: MotCles::class, mappedBy: 'nom')]
    private Collection $motscles;

    #[ORM\ManyToMany(targetEntity: MotCles::class, mappedBy: 'marquepage')]
    private Collection $motCles;

    

    public function __construct()
    {
        $this->motscles = new ArrayCollection();
        $this->motCles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }


    /**
     * @return Collection<int, MotCles>
     */
    public function getMotCles(): Collection
    {
        return $this->motCles;
    }

    public function addMotCle(MotCles $motCle): static
    {
        if (!$this->motCles->contains($motCle)) {
            $this->motCles->add($motCle);
            $motCle->addMarquepage($this);
        }

        return $this;
    }

    public function removeMotCle(MotCles $motCle): static
    {
        if ($this->motCles->removeElement($motCle)) {
            $motCle->removeMarquepage($this);
        }

        return $this;
    }

}

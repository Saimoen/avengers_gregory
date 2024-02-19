<?php

namespace App\Entity;

use App\Repository\MotClesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotClesRepository::class)]
class MotCles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contenu = null;

    #[ORM\ManyToMany(targetEntity: MarquePage::class, inversedBy: 'motCles')]
    private Collection $marquepage;

    public function __construct()
    {
        $this->marquepage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, MarquePage>
     */
    public function getMarquepage(): Collection
    {
        return $this->marquepage;
    }

    public function addMarquepage(MarquePage $marquepage): static
    {
        if (!$this->marquepage->contains($marquepage)) {
            $this->marquepage->add($marquepage);
        }

        return $this;
    }

    public function removeMarquepage(MarquePage $marquepage): static
    {
        $this->marquepage->removeElement($marquepage);

        return $this;
    }
}

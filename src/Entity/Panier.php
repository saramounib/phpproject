<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Client $client = null;


    #[ORM\OneToMany(targetEntity: LignePanier::class, mappedBy: 'panier', cascade: ['persist', 'remove'])]
    private Collection $lignes;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $datePanier = null;

    public function __construct()
    {
        $this->lignes = new ArrayCollection();
        $this->datePanier = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Collection<int, LignePanier>
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    public function addLigne(LignePanier $ligne): self
    {
        if (!$this->lignes->contains($ligne)) {
            $this->lignes->add($ligne);
            $ligne->setPanier($this);
        }
        return $this;
    }

    public function removeLigne(LignePanier $ligne): self
    {
        if ($this->lignes->removeElement($ligne)) {
            if ($ligne->getPanier() === $this) {
                $ligne->setPanier(null);
            }
        }
        return $this;
    }

    public function getDatePanier(): ?\DateTime
    {
        return $this->datePanier;
    }

    public function setDatePanier(\DateTime $datePanier): self
    {
        $this->datePanier = $datePanier;
        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\LignePanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LignePanierRepository::class)]
class LignePanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, Panier>
     */
    #[ORM\OneToMany(targetEntity: Panier::class, mappedBy: 'lignePanier')]
    private Collection $idPanier;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'lignePanier')]
    private Collection $idProduit;

    public function __construct()
    {
        $this->idPanier = new ArrayCollection();
        $this->idProduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;
        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getIdPanier(): Collection
    {
        return $this->idPanier;
    }

    public function addIdPanier(Panier $panier): static
    {
        if (!$this->idPanier->contains($panier)) {
            $this->idPanier->add($panier);
            $panier->setLignePanier($this);
        }
        return $this;
    }

    public function removeIdPanier(Panier $panier): static
    {
        if ($this->idPanier->removeElement($panier)) {
            if ($panier->getLignePanier() === $this) {
                $panier->setLignePanier(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Produit $produit): static
    {
        if (!$this->idProduit->contains($produit)) {
            $this->idProduit->add($produit);
            $produit->setLignePanier($this);
        }
        return $this;
    }

    public function removeIdProduit(Produit $produit): static
    {
        if ($this->idProduit->removeElement($produit)) {
            if ($produit->getLignePanier() === $this) {
                $produit->setLignePanier(null);
            }
        }
        return $this;
    }
}

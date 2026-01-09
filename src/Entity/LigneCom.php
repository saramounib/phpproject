<?php

namespace App\Entity;

use App\Repository\LigneComRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneComRepository::class)]
class LigneCom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'ligneCom')]
    private Collection $idProduit;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'ligneCom')]
    private Collection $idCommande;

    public function __construct()
    {
        $this->idProduit = new ArrayCollection();
        $this->idCommande = new ArrayCollection();
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
            $produit->setLigneCom($this);
        }
        return $this;
    }

    public function removeIdProduit(Produit $produit): static
    {
        if ($this->idProduit->removeElement($produit)) {
            if ($produit->getLigneCom() === $this) {
                $produit->setLigneCom(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getIdCommande(): Collection
    {
        return $this->idCommande;
    }

    public function addIdCommande(Commande $commande): static
    {
        if (!$this->idCommande->contains($commande)) {
            $this->idCommande->add($commande);
            $commande->setLigneCom($this);
        }
        return $this;
    }

    public function removeIdCommande(Commande $commande): static
    {
        if ($this->idCommande->removeElement($commande)) {
            if ($commande->getLigneCom() === $this) {
                $commande->setLigneCom(null);
            }
        }
        return $this;
    }
}

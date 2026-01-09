<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: 'float')]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Vendeur>
     */
    #[ORM\OneToMany(targetEntity: Vendeur::class, mappedBy: 'produit')]
    private Collection $vendeurs;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?LignePanier $lignePanier = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?LigneCom $ligneCom = null;

    public function __construct()
    {
        $this->vendeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;
        return $this;
    }

    /**
     * @return Collection<int, Vendeur>
     */
    public function getVendeurs(): Collection
    {
        return $this->vendeurs;
    }

    public function addVendeur(Vendeur $vendeur): static
    {
        if (!$this->vendeurs->contains($vendeur)) {
            $this->vendeurs->add($vendeur);
            $vendeur->setProduit($this);
        }
        return $this;
    }

    public function removeVendeur(Vendeur $vendeur): static
    {
        if ($this->vendeurs->removeElement($vendeur)) {
            if ($vendeur->getProduit() === $this) {
                $vendeur->setProduit(null);
            }
        }
        return $this;
    }

    public function getLignePanier(): ?LignePanier
    {
        return $this->lignePanier;
    }

    public function setLignePanier(?LignePanier $lignePanier): static
    {
        $this->lignePanier = $lignePanier;
        return $this;
    }

    public function getLigneCom(): ?LigneCom
    {
        return $this->ligneCom;
    }

    public function setLigneCom(?LigneCom $ligneCom): static
    {
        $this->ligneCom = $ligneCom;
        return $this;
    }
}

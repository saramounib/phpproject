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

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $idCategorie = null;

    /**
     * @var Collection<int, Vendeur>
     */
    #[ORM\OneToMany(targetEntity: Vendeur::class, mappedBy: 'produit')]
    private Collection $idVendeur;

    #[ORM\ManyToOne(inversedBy: 'idProduit')]
    private ?LignePanier $lignePanier = null;

    #[ORM\ManyToOne(inversedBy: 'idProduit')]
    private ?LigneCom $ligneCom = null;

    public function __construct()
    {
        $this->idVendeur = new ArrayCollection();
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

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(Categorie $idCategorie): static
    {
        $this->idCategorie = $idCategorie;
        return $this;
    }

    /**
     * @return Collection<int, Vendeur>
     */
    public function getIdVendeur(): Collection
    {
        return $this->idVendeur;
    }

    public function addIdVendeur(Vendeur $idVendeur): static
    {
        if (!$this->idVendeur->contains($idVendeur)) {
            $this->idVendeur->add($idVendeur);
            $idVendeur->setProduit($this);
        }
        return $this;
    }

    public function removeIdVendeur(Vendeur $idVendeur): static
    {
        if ($this->idVendeur->removeElement($idVendeur)) {
            if ($idVendeur->getProduit() === $this) {
                $idVendeur->setProduit(null);
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

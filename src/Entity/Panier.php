<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $datePanier = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'panier')]
    private Collection $idClient;

    #[ORM\ManyToOne(inversedBy: 'idPanier')]
    private ?LignePanier $lignePanier = null;

    public function __construct()
    {
        $this->idClient = new ArrayCollection();
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

    public function getDatePanier(): ?\DateTime
    {
        return $this->datePanier;
    }

    public function setDatePanier(\DateTime $datePanier): static
    {
        $this->datePanier = $datePanier;
        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getIdClient(): Collection
    {
        return $this->idClient;
    }

    public function addIdClient(Client $client): static
    {
        if (!$this->idClient->contains($client)) {
            $this->idClient->add($client);
            $client->setPanier($this);
        }
        return $this;
    }

    public function removeIdClient(Client $client): static
    {
        if ($this->idClient->removeElement($client)) {
            if ($client->getPanier() === $this) {
                $client->setPanier(null);
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
}

<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateCommande = null;

    /**
     * @var Collection<int, client>
     */
    #[ORM\OneToMany(targetEntity: client::class, mappedBy: 'Commande')]
    private Collection $id_client;

    #[ORM\ManyToOne(inversedBy: 'idCommande')]
    private ?LigneCom $ligneCom = null;

    public function __construct()
    {
        $this->id_client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTime
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTime $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * @return Collection<int, client>
     */
    public function getIdClient(): Collection
    {
        return $this->id_client;
    }

    public function addIdClient(client $idClient): static
    {
        if (!$this->id_client->contains($idClient)) {
            $this->id_client->add($idClient);
            $idClient->setCommande($this);
        }

        return $this;
    }

    public function removeIdClient(client $idClient): static
    {
        if ($this->id_client->removeElement($idClient)) {
            // set the owning side to null (unless already changed)
            if ($idClient->getCommande() === $this) {
                $idClient->setCommande(null);
            }
        }

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

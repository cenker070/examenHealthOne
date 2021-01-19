<?php

namespace App\Entity;

use App\Repository\MedicijnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicijnRepository::class)
 */
class Medicijn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $werking;

    /**
     * @ORM\Column(type="text")
     */
    private $bijwerking;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verzekerd;

    /**
     * @ORM\OneToMany(targetEntity=Recept::class, mappedBy="medicijn")
     */
    private $recepten;

    public function __construct()
    {
        $this->recepten = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getWerking(): ?string
    {
        return $this->werking;
    }

    public function setWerking(string $werking): self
    {
        $this->werking = $werking;

        return $this;
    }

    public function getBijwerking(): ?string
    {
        return $this->bijwerking;
    }

    public function setBijwerking(string $bijwerking): self
    {
        $this->bijwerking = $bijwerking;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getVerzekerd(): ?bool
    {
        return $this->verzekerd;
    }

    public function setVerzekerd(bool $verzekerd): self
    {
        $this->verzekerd = $verzekerd;

        return $this;
    }

    /**
     * @return Collection|Recept[]
     */
    public function getRecepten(): Collection
    {
        return $this->recepten;
    }

    public function addRecepten(Recept $recepten): self
    {
        if (!$this->recepten->contains($recepten)) {
            $this->recepten[] = $recepten;
            $recepten->setMedicijn($this);
        }

        return $this;
    }

    public function removeRecepten(Recept $recepten): self
    {
        if ($this->recepten->removeElement($recepten)) {
            // set the owning side to null (unless already changed)
            if ($recepten->getMedicijn() === $this) {
                $recepten->setMedicijn(null);
            }
        }

        return $this;
    }
}
